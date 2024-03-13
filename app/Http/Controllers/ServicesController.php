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
                    "program_introduction" => "<p>Transform Your Body, Transform Your Confidence<br>

                In the pursuit of a healthier lifestyle and a better body, we often find ourselves desiring to tone and strengthen specific areas of our physique. The glutes, undoubtedly, are one of those areas that catch our attention and ignite the desire to enhance their appearance. However, not everyone has the time or convenience of regularly attending a gym. Don't worry! This glute program designed specifically for home use is the perfect solution for you.<br>
                
                Your Transformation in 12 Weeks<br>
                
                This 12-week workout program is tailored for individuals of all kinds who wish to transform the look and strength of their glutes without the need for expensive gym equipment. We will utilize simple yet effective tools such as dumbbells, resistance bands, a chair, and an exercise mat. With the right guidance and consistent commitment, you'll be on your way to stronger and more toned glutes in the comfort of your own home.<br>
                
                Proven Techniques for Real Results<br>
                
                This program is based on proven training techniques that have demonstrated their effectiveness in developing glute muscles. Each exercise has been carefully selected to maximize muscle growth and definition. Moreover, our focus is not only on aesthetics but also on functionality, enabling you to enjoy a more active and healthier life.<br>
                
                Warm-Up and Stretching: Take Care of Your Body<br>
                
                Before embarking on any workout, it is essential to properly prepare your body for the effort. Our program includes a warm-up and stretching section designed to minimize the risk of injuries and improve flexibility. A well-prepared body is the foundation of effective training.<br>
                
                Smart Nutrition: Combine Exercise and Diet<br>
                
                Nutrition plays a pivotal role in your quest for toned glutes. While we provide some general nutritional recommendations, it's important to emphasize that a personalized approach with the assistance of a nutrition professional is ideal. Our nutrition section offers you an initial guide to understanding the basic principles and making informed choices.<br>
                
                Progress Analytics: Track Your Evolution<br>
                
                We understand that tracking your progress is crucial to stay motivated and ensure you are progressing towards your goals. We provide tools and advice to help you measure your advancement over the 12 weeks.<br>
                
                Cardio for Balanced Fitness<br>
                
                In addition to specific glute exercises, we also offer recommendations for cardiovascular exercises that complement your training program. A proper balance between resistance and cardio exercises will help you effectively reach your goals.<br>
                
                This program is designed not only to enhance the appearance of your glutes but also to provide you with a higher level of confidence and overall well-being. Get ready to embark on a personal transformation journey that will lead you to discover your best self!</p>",
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