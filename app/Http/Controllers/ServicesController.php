<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\UserWeight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ServicesController extends Controller
{
    public function bdrcalculator(Request $request)
    {
        $age = (int) $request->age;
        $heightInput = $request->height; // Height could be in cm or feet (e.g., 5'10")
        $weight = (double) $request->weight; // Assuming weight is in kg, even if provided as a string

        // Check if height is provided in feet and inches, and convert to cm if necessary
        if (strpos($heightInput, '"') !== false) {
            // Height is in feet and inches, e.g., 5'10"
            [$feet, $inches] = explode("'", str_replace("\"", "", $heightInput));
            $height = $this->convertFeetAndInchesToCentimeters((int) $feet, (int) $inches);
        } else {
            // Height is assumed to be in centimeters
            $height = (double) $heightInput;
        }

        // BMR calculation (Mifflin-St Jeor Equation for men, example)
        $bmr = (10 * $weight) + (6.25 * $height) - (5 * $age) + 5;

        // TDEE calculation with moderate activity level (activity factor of 1.55)
        $tdee = $bmr * 1.55;

        return response()->json(['bmr' => $bmr, 'tdee' => $tdee]);
    }

    protected function convertFeetAndInchesToCentimeters(int $feet, int $inches): float
    {
        return($feet * 30.48) + ($inches * 2.54);
    }
    public function getUserWeightsBy(Request $request)
    {
        $groupBy = $request->query('groupBy', 'month'); // Default to month

        $weights = UserWeight::select('date', 'weight')
            // ->where('user_id', $userId)
            ->get();

        return response()->json($weights);
    }
    public function getAnalyticsInfo(Request $request)
    {
        // $weights = UserWeight::select('date', 'weight')
        // ->where('user_id', $userId)
        // ->get();
        // Static data for demonstration
        $weights = [
            [
                "date" => "2021-01-01",
                "weight" => 100
            ],
            [
                "date" => "2021-02-01",
                "weight" => 95
            ]
        ];
        $hr = [
            [
                "date" => "2021-01-01",
                "hr" => 100
            ],
            [
                "date" => "2021-02-01",
                "hr" => 95
            ]
        ];

        $image_progress = [
            [
                "date" => "2021-01-01",
                "image_url" => "https://placehold.co/400.jpg"
            ],
            [
                "date" => "2021-02-01",
                "image_url" => "https://placehold.co/400.jpg"
            ]
        ];

        // Using response()->json() to correctly format the response
        return response()->json([
            'hr' => $hr,
            'weights' => $weights,
            'image_progress' => $image_progress
        ]);
    }


    //IDS AS STRING, duration_of_workout
    public function getPackages()
    {
        return response()->json([
            "data" => [
                [
                    "id" => 1,
                    "pre_name" => "Build Your Glutes  from Home",
                    "package_name" => "Booty Blast.",
                    "price" => 150.00,
                    "has_access" => true,
                    "isPublic" => true,
                    "featured_image_url" => "https://lorevera.s3.us-east-1.amazonaws.com/images/lorevera-package.jpg",
                    "program_overview" => "<p<This 12-week at-home program focuses on toning and increasing the volume of your glutes and legs using resistance bands, a chair, a mat, and dumbbells. You'll achieve firmer, more defined, and voluminous glutes while improving leg strength and functionality, all from the comfort of your home</p>",
                    "program_introduction" => "<p>Transform Your Body, Transform Your Confidence</p>

                <p>In the pursuit of a healthier lifestyle and a better body, we often find ourselves desiring to tone and strengthen specific areas of our physique. The glutes, undoubtedly, are one of those areas that catch our attention and ignite the desire to enhance their appearance. However, not everyone has the time or convenience of regularly attending a gym. Don't worry! This glute program designed specifically for home use is the perfect solution for you.</p>
                        <ul>
                            <li>12-week program</li>
                            <li>3-4 workouts per week</li>
                            <li>60-90 minutes per workout</li>
                            <li>Full-body focus</li>
                            <li>Home or gym-based</li>
                        </ul>
                        <ol>
                            <li>12-week program</li>
                            <li>3-4 workouts per week</li>
                            <li>60-90 minutes per workout</li>
                            <li>Full-body focus</li>
                            <li>Home or gym-based</li>
                        </ol>
                        <img src='https://lorevera.s3.us-east-1.amazonaws.com/images/lorevera-package.jpg' alt='Sample Image' />
                        <a href='wwww.google.com'> Sample Link </a>
                ",
                    "duration_of_package" => "12",
                    "duration_of_workout" => "60-90",
                    "duration_per_week" => "3-4",
                    "focus" => "Full Body",
                    "based" => "Home or Gym",
                    "exercises_groups" => [
                        [
                            "week" => "1 - 4",
                            "exercises" => [
                                [
                                    "id" => 1,
                                    "name" => "Squat",
                                    "isPublic" => true,
                                    "featured_image_url" => "https://lorevera.s3.us-east-1.amazonaws.com/images/placeholder-exercise.jpg",
                                    "description" => "A fundamental exercise for lower body strength. Make sure to keep your back straight and knees in line with your feet.",
                                    "equipment" => [
                                        ["id" => 1, "name" => "Dumbbell", "image_url" => "https://lorevera.s3.us-east-1.amazonaws.com/images/lorevera-dumpbell.jpg"],
                                        ["id" => 2, "name" => "Mat", "image_url" => "https://lorevera.s3.us-east-1.amazonaws.com/images/Lorevera-mat.jpg"]
                                    ],
                                    "warm_up_exercises" => [
                                        [
                                            "id" => 1,
                                            "name" => "Leg Swings",
                                            "description" => "Prepare your legs and hips for squats by performing leg swings. Stand next to a wall for support and swing your leg forward and back.",
                                            "image_url" => "https://lorevera.s3.us-east-1.amazonaws.com/images/placeholder-exercise.jpg",
                                            "sets" => "2",
                                            "reps" => "10-15",
                                            "video_url" => "https://lorevera.s3.us-east-1.amazonaws.com/images/backkneeup.mp4"
                                        ],
                                        [
                                            "id" => 2,
                                            "name" => "Ankle Circles",
                                            "description" => "Improve ankle mobility with ankle circles. Sit down and extend your leg, rotating your foot in a circular motion.",
                                            "image_url" => "https://lorevera.s3.us-east-1.amazonaws.com/images/placeholder-exercise.jpg",
                                            "sets" => "2",
                                            "reps" => "10 each direction",
                                            "video_url" => "https://lorevera.s3.us-east-1.amazonaws.com/images/backkneeup.mp4"
                                        ]
                                    ]
                                ],
                                [
                                    "id" => 2,
                                    "name" => "Push-Up",
                                    "featured_image_url" => "https://lorevera.s3.us-east-1.amazonaws.com/images/placeholder-exercise.jpg",
                                    "description" => "A key exercise for upper body strength. Keep your body in a straight line from head to heels.",
                                    "equipment" => [
                                    ],
                                    "warm_up_exercises" => [
                                        [
                                            "id" => 3,
                                            "name" => "Arm Circles",
                                            "description" => "Warm up your shoulders and arms with arm circles. Stand with your arms extended and rotate them in a circular motion.",
                                            "image_url" => "https://lorevera.s3.us-east-1.amazonaws.com/images/placeholder-exercise.jpg",
                                            "sets" => "2",
                                            "reps" => "10-15 each direction",
                                            "video_url" => "https://lorevera.s3.us-east-1.amazonaws.com/images/backkneeup.mp4"
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            "total" => 1,
            "current_page" => 1,
            "per_page" => 10
        ]);
    }

}