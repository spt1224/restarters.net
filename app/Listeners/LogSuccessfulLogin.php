<?php

namespace App\Listeners;

use App\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use \Mediawiki\Api\ApiUser;
use \Mediawiki\Api\MediawikiApi;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {

        $u = User::find($event->user->id);
        $u->number_of_logins += 1;
        $u->save();

        if( !is_null($u->mediawiki) && !empty($u->mediawiki) ) {

          $api = MediawikiApi::newFromApiEndpoint( env('WIKI_URL').'/api.php' );
          $api->login( new ApiUser( $u->mediawiki, $this->request->input('password') ) );
          //dd($api);

        }

    }
}
