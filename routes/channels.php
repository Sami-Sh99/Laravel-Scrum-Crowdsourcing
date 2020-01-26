<?php
use App\WorkshopEnrollment;
use App\Workshop;
/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('workshop.BgsFNDh', function ($user, $key) {
    return true;
    $workshop = Workshop::findWorkshopByKey($key);
    return WorkshopEnrollment::isParticipantEnrolled($workshop->id,$user->id);
});

Broadcast::channel('my-channel', function ($user, $key) {
    $workshop = Workshop::findWorkshopByKey('BgsFNDh');
    $workshop->title="sami";
    $workshop->save();
    return ['name'=>19];
    return WorkshopEnrollment::isParticipantEnrolled($workshop->id,$user->id);
});