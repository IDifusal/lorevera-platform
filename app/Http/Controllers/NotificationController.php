<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use App\Http\Controllers\Controller;
use App\Models\ScheduledNotification;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase\Exception\Messaging\NotFound;

class NotificationController extends Controller
{

    public function sendTestNotification()
    {
        $jsonContent = '{
            "type": "service_account",
            "project_id": "fitvera-76e6a",
            "private_key_id": "ba2bf980d8be00bacec7cc0ed4c837d1056d893a",
            "private_key": "-----BEGIN PRIVATE KEY-----\nMIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQDCSVW+77P113Ra\nJHr87enWy0lg13vUHcnV+SvuI+osGiYp0Y//6TzQhcavwEa0qQvucBDX2OM/vXso\neb2Do8CTO8wT9kzRdzXX0gZnU++ZdGIQV4/F+sQ5Q9AcTfAD8nJ8zUmI6M49Ci1/\nwBZLrk67xV7a3y/OW49N78b40DUOIj7yrGDCjHkJTA9RchEh8JnkcP4eMweSYsSu\ne/17MS8/o3rdg822B36ow7vVovmyOLIryM7lOD1V6tBCMCSmglxTs3db5P0ZXkGU\n9BrDfyevkxIxuWZDqvqGINYUL4CR5mWPKR/sHN+T9FhLKEY5E0boqlXIFQxybhPs\nBPAJ+9LxAgMBAAECggEAYPCudAKuTHAgggnJxAIBt0bfag6ano/ucXFOVhhdc3vo\npt0FeK8rxO+6316U6PegGGyaOtjhKqCknuF/iftezxf7D8rJMYrFttX4k/3xgyPq\n+jR2bFZfKiOH51eL9qw2K8dSdZmTrikx4pg5h7GFX3NvjM3n0JMmwcBuCx/4GQBm\nkREsC0BVSvIrJPTVPRTxwBbEq0clrN3ioWmDRDLKop7301J38xeryY4+gdDskuGZ\nJfKDbFQjgw9IZAkmOADA/m2OHuouZkEnRFazJ1LB1EYs35EYpPRa6ijB8rjJs+y9\nfWPSdIP+tlt5sAyStfioSORiPW2XZllmmzXEHT+PcQKBgQDp6muoqEXir7e5g5KW\nDv3rCHC5n1zAc/axgbul79YxpDLlC9xa7SQ7TnY9N2Ful69xxdSLBJfdJj2JceJw\nQcVOZsRYtdInkn5A/ll58ZRFJUGyqKF04baZRl/1I2Yb3i9SJ30W1xTS9l1y7uie\nko4Z+8d9+FLn65SaXGjY/+xGjwKBgQDUoRpxi/I4cSHs19zVRwn9k8DZScp278wv\nPRC446XHq/Yn4qvmm0vNIQsDLI5HFsrrOZ1i+3eCy6qOd7uSQEu/vQiTEvwW0LAc\nGjyf5WFnMrrVRCdhKTw/sOWkQZbZABLBR8h4f4u8Hh7NeIIldEO9pqw0hWL4T3p1\nLA51JgcOfwKBgQCeCL+lmdJlXZw93LOLaCOKyBAIiK9MYsxXjrOtX0USEsJD1uiQ\nEck5vD/MCf9sjVR+BE8dgQPs6GoI0wVOHFFmL64V1PlfvOxJks32wg0PTiV9w8oZ\nQmlwUoiAAON6jnjgA0fSx4sNIF9wSBKnF5Kj4WQdKkkw4Qtr4mT/vp/t5wKBgAfO\nWlAs2RmlXZ96VUsnLoC2ue/AO8SeDRr23PRMtztbXtAcDD+NF/1R5zuYmSiW96An\nH1YQ8VRF8d8FGkfGQIGriPMNUV/tDWoatHsSSr8lJ6LIu8FfaCzWa7faCJWy4P1j\ni0KRPCoN2QemEvEZEZuW0N+kvftrv40pruYyHTQ1AoGBAJl5Z0s37yg1tB2rIZce\nFCK2/rMYPU+HG0xHtkvp8uFAYiW5fzJ68W194cmhdKI8QYYxUY81scKilCLyepbm\nVFZtni6fmFrnR6RnoxOZNjiy6klo5PWZvdFWXE6CB7XDnH1BDHOk/o2L/fGkT6Y2\nFsoHScapUKu1tizIyUVe2TIx\n-----END PRIVATE KEY-----\n",
            "client_email": "firebase-adminsdk-ybx0w@fitvera-76e6a.iam.gserviceaccount.com",
            "client_id": "114868855716025695761",
            "auth_uri": "https://accounts.google.com/o/oauth2/auth",
            "token_uri": "https://oauth2.googleapis.com/token",
            "auth_provider_x509_cert_url": "https://www.googleapis.com/oauth2/v1/certs",
            "client_x509_cert_url": "https://www.googleapis.com/robot/v1/metadata/x509/firebase-adminsdk-ybx0w%40fitvera-76e6a.iam.gserviceaccount.com",
            "universe_domain": "googleapis.com"
          }';


        // Use the predefined device token
        $deviceToken = 'eVSpzuVnTESOxHbucW6xG2:APA91bHoIXQt_kEOTU8RSab99DhjQSetKkYnLcIBAgehoH7hb56Ev6QJSEiD8cU8qh8oR3Fj5dZg4ii1prHpT1RoAZdjE4bTSfVYATcGWJbjBnkpNeerMSAmfHGX_A8qv76QRCa4HGHz';

        // Message content
        $title = 'Test Notification';
        $body = 'This is a test notification sent from the test endpoint.';
        $serviceAccount = json_decode($jsonContent, true);
        // Initialize Firebase Messaging
        try {
            $factory = (new Factory)->withServiceAccount($serviceAccount);
            $messaging = $factory->createMessaging();
        } catch (\Throwable $e) {
            logger()->error('Failed to initialize Firebase Messaging', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to initialize Firebase Messaging'], 500);
        }

        // Create and send the notification
        $message = CloudMessage::withTarget('token', $deviceToken)
            ->withNotification(Notification::create('Title', 'Body'))
            ->withData( ['title' => $title, 'body' => $body]);
        

        try {
            $messaging->send($message);
            logger()->info('Notification sent successfully', ['deviceToken' => $deviceToken]);
        } catch (NotFound $e) {
            logger()->error('FCM token not found or invalid', ['error' => $e->getMessage(), 'token' => $deviceToken]);
        } catch (\Throwable $e) {
            logger()->error('Failed to send notification', ['error' => $e->getMessage()]);
        }

        return response()->json(['message' => 'Test notification sent successfully']);
    }
    public function schedule(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'type' => 'required|string',
            'message' => 'required|string',
            'scheduled_at' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $notification = ScheduledNotification::create([
            'user_id' => $request->user_id,
            'type' => $request->type,
            'message' => $request->message,
            'scheduled_at' => $request->scheduled_at,
        ]);

        return response()->json(['message' => 'Notification scheduled successfully', 'notification' => $notification], 201);
    }
}
