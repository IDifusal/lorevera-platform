<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
 
 
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
        return ($feet * 30.48) + ($inches * 2.54);
    } 
    public function getPackages(){
        return response()->json([
           "data"=> [
                "id" => 1,
                "name" => "Ultimate Fitness Challenge",
                "price" => 150.00,
                "featured_image_url" => "https://example.com/package.jpg",
                "description" => "A comprehensive fitness program designed for all levels.",
                "program_introduction" => "Start your journey with our Ultimate Fitness Challenge. This program is designed to help you achieve your fitness goals with a focus on strength, flexibility, and endurance.",
                "duration_of_workout" => "60-90 minutes",
                "duration_per_week" => "3-4 days",
                "focus" => "Full Body",
                "based" => "Home or Gym",
                "exercises" => [
                    [
                        "id" => 1,
                        "name" => "Squat",
                        "featured_image_url" => "https://example.com/squat.jpg",
                        "description" => "A fundamental exercise for lower body strength. Make sure to keep your back straight and knees in line with your feet.",
                        "equipment" => [
                            ["id" => 1, "name" => "Dumbbell"],
                            ["id" => 2, "name" => "Mat"]
                        ],
                        "warm_up_exercises" => [
                            [
                                "id" => 1,
                                "name" => "Leg Swings",
                                "description" => "Prepare your legs and hips for squats by performing leg swings. Stand next to a wall for support and swing your leg forward and back.",
                                "image_url" => "https://example.com/leg_swing.jpg",
                                "sets" => "2",
                                "reps" => "10-15"
                            ],
                            [
                                "id" => 2,
                                "name" => "Ankle Circles",
                                "description" => "Improve ankle mobility with ankle circles. Sit down and extend your leg, rotating your foot in a circular motion.",
                                "image_url" => "https://example.com/ankle_circle.jpg",
                                "sets" => "2",
                                "reps" => "10 each direction"
                            ]
                        ]
                    ],
                    [
                        "id" => 2,
                        "name" => "Push-Up",
                        "featured_image_url" => "https://example.com/pushup.jpg",
                        "description" => "A key exercise for upper body strength. Keep your body in a straight line from head to heels.",
                        "equipment" => [
                            ["id" => 3, "name" => "None"]
                        ],
                        "warm_up_exercises" => [
                            [
                                "id" => 3,
                                "name" => "Arm Circles",
                                "description" => "Warm up your shoulders and arms with arm circles. Stand with your arms extended and rotate them in a circular motion.",
                                "image_url" => "https://example.com/arm_circle.jpg",
                                "sets" => "2",
                                "reps" => "10-15 each direction"
                            ]
                        ]
                    ]
                ]
                            ],
                            "total"=> 1,
                            "current_page"=>1,
                            "per_page"=> 10
        ]);
    }
    
}