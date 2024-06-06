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
        $gender = $request->gender; // Add gender parameter
    
        // Correctly access the height and weight values and units
        $heightUnit = $request->height['unit'];
        $heightValue = (double) $request->height['value'];
        $weightUnit = $request->weight['unit'];
        $weightValue = (double) $request->weight['value'];
    
        // Convert height to centimeters if in feet
        if ($heightUnit === 'ft') {
            $height = $this->convertFeetToCentimeters($heightValue);
        } else {
            $height = $heightValue;
        }
    
        // Convert weight to kg if in pounds
        if ($weightUnit === 'lb') {
            $weight = $this->convertPoundsToKg($weightValue);
        } else {
            $weight = $weightValue;
        }
    
        // Adjust BMR calculation based on gender
        if ($gender === 'man') {
            $bmr = (10 * $weight) + (6.25 * $height) - (5 * $age) + 5;
        } else if ($gender === 'woman') {
            $bmr = (10 * $weight) + (6.25 * $height) - (5 * $age) - 161;
        } else {
            return response()->json(['error' => 'Invalid gender specified'], 400);
        }
    
        $tdee = $bmr * 1.55;
    
        return response()->json(['bmr' => $bmr, 'tdee' => $tdee]);
    }
    

    private function convertFeetToCentimeters($feet)
    {
        return $feet * 30.48;
    }

    private function convertPoundsToKg($pounds)
    {
        return $pounds * 0.453592;
    }

    protected function convertFeetAndInchesToCentimeters(int $feet, int $inches): float
    {
        return ($feet * 30.48) + ($inches * 2.54);
    }
    public function getUserWeightsBy(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;

        $weights = UserWeight::select('date', 'weight')
            ->where('user_id', $userId)
            ->orderBy('date', 'desc')
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
    public function getInfoModules()
    {
        //Modules return html with dummy info, analytics,Goals, limitations, weight, how to measure, how to take photo
        return response()->json([
            'substitution_list'=>[
                'sections'=>[
                    [
                        'title'=>'Meat plan',
                        'data'=>"<p>

                        These options provide a variety of flavors and nutrients to help customers create a balanced and delicious vegan diet. Remember to consider personal preferences, food allergies, and individual dietary needs when making choices at the supermarket.</p>"
                    ],
                    [
                        'title'=>'Vegetarian Plan',
                        'data'=>"<p>Recommendation:

                        When shopping at the supermarket as part of a vegan diet, it's essential to take advantage of the wide range of options available in each food category. You can choose from fresh fruits like apples and oranges or experiment with nutritious vegetables such as spinach and broccoli. Regarding carbohydrates, eating whole foods like quinoa and brown rice can provide additional health benefits. Consider incorporating tofu, lentils, or powdered products like peas or hemp for plant-based proteins. Lastly, remember healthy fats, such as those found in avocados, olive oil, and nuts, which can be essential for a balanced diet. You can enjoy a nutritious and delicious vegan diet by making intelligent choices at the supermarket and experimenting with these versatile options.</p>"
                    ]
                ]
            ],
            'macro_calculator'=>[
                'sections'=>[
                    [
                        'title'=>'Macro Calculator',
                        'data'=>"<p>Keeping an accurate record of your macronutrients is essential for achieving your health and fitness goals. With our macro calculation tool, you can get personalized guidance on the amount of carbohydrates, proteins, and fats you should consume daily. Here's how to use it:<br><br><strong>Step 1: Personal Profile</strong><br>
                            We'll start by creating your personal profile. Enter your age, weight, height, and gender. These details will help us calculate your calorie and macronutrient needs more accurately.<br><br>
                            
                            <strong>Step 2: Activity Level</strong><br>
                            Select your level of physical activity. You can choose from options like sedentary, lightly active, moderately active, very active, or extremely active. This choice reflects your calorie expenditure based on your lifestyle.<br><br>
                            
                            <strong>Step 3: Nutritional Goals</strong><br>
                            Define your nutritional goals. Do you want to lose weight, gain muscle, or simply maintain your current weight? You can also tailor these goals to your dietary preferences, such as a low-carb or high-protein diet.<br><br>
                            
                            <strong>Step 4: Macro Calculation</strong><br>
                            Once you've provided all of this information, our app will perform a personalized calculation to determine the amount of carbohydrates, proteins, and fats you should consume in your daily diet to reach your goals. We will provide specific recommendations based on your individual needs.
                            <br><br>
                            <strong>Step 5: Tracking and Planning</strong><br>
                            Ready to go! Now you can use this information to plan your meals and keep a record of your daily intake. Our app will also allow you to track your progress and make adjustments to your diet as needed.<br><br>
                            
                            With our macro calculation app, you have a powerful tool to optimize your nutrition and move toward a healthier lifestyle. We hope you find this feature helpful on your journey to your health and fitness goals!
                            </p>"
                    ]
                ]
            ],
            'analytics' => [
                'sections' => [
                    [
                        'title' => 'Analytics',
                        'data' => '<p>Here you can see your progress</p>'
                    ]
                ]
            ],
            'goals' => [
                'sections' => [
                    [
                        'title' => 'Goals',
                        'data' => '<p>Here you can see your goals</p>'
                    ]
                ]
            ],
            'limitations' => [
                'sections' => [
                    [
                        'title' => 'Limitations',
                        'data' => '<p>Here you can see your limitations</p>'
                    ]
                ]
            ],
            'weight' => [
                'sections' => [
                    [
                        'title' => 'Weight',
                        'data' => '<p>Here you can see your weight</p>'
                    ]
                ]
            ],
            'how_to_measure' => [
                'sections' => [
                    [
                        'title' => 'How to Measure',
                        'data' => '<p>Here you can see how to measure</p>'
                    ]
                ]
            ],
            'how_to_take_photo' => [
                'sections' => [
                    [
                        'title' => 'How to Take a Photo',
                        'data' => '<p>Here you can see how to take photo</p>'
                    ]
                ]
            ],
            'bio' => [
                'sections' => [
                    [
                        'title' => 'About Lorena',
                        'data' => "<p>Welcome to my world of strength, stability, and flexibility! I'm Lorena, A passionate bodybuilding athlete and ISSA-certified Glute Specialist...</p>"
                    ]
                ]
            ],
            'nutrition' => [
                'sections' => [
                    [
                        'title' => 'Meat plan',
                        'data' => '<h1>Introduction</h1><p>This is the first part of our discussion.</p>'
                    ],
                    [
                        'title' => 'Vegetarian Plan',
                        'data' => '<h1>Deep Dive</h1><p>Here we delve deeper into the details.</p>'
                    ]
                ]
            ]
        ]);
    }
    public function calculateMacros(Request $request)
    {
        // Validate request input
        $request->validate([
            'age' => 'required|integer|min:1',
            'weight.value' => 'required|numeric',
            'weight.type' => 'required|string|in:kg,lb',
            'height.value' => 'required|numeric',
            'height.type' => 'required|string|in:cm,ft',
            'activity_level' => 'required|string|in:sedentary,lightly_active,moderately_active,very_active,extra_active',
            'goal' => 'required|string|in:lose_weight,gain_weight,mantain'
        ]);

        // Extract input parameters
        $age = $request->age;
        $weightValue = $request->weight['value'];
        $weightType = $request->weight['type'];
        $heightValue = $request->height['value'];
        $heightType = $request->height['type'];
        $activityLevel = $request->activity_level;
        $goal = $request->goal;

        // Convert weight to kg if necessary
        if ($weightType == 'lb') {
            $weightValue = $weightValue * 0.453592;
        }

        // Convert height to cm if necessary
        if ($heightType == 'ft') {
            $heightValue = $heightValue * 30.48;
        }

        // Calculate BMR using the Mifflin-St Jeor formula (for males)
        $bmr = (10 * $weightValue) + (6.25 * $heightValue) - (5 * $age) + 5;

        // Adjust BMR based on activity level
        $activityFactors = [
            'sedentary' => 1.2,
            'lightly_active' => 1.375,
            'moderately_active' => 1.55,
            'very_active' => 1.725,
            'extra_active' => 1.9
        ];
        $tdee = $bmr * $activityFactors[$activityLevel];

        // Adjust TDEE based on the goal
        switch ($goal) {
            case 'lose_weight':
                $tdee -= 500; // Create a calorie deficit
                break;
            case 'gain_weight':
                $tdee += 500; // Create a calorie surplus
                break;
            case 'mantain':
            default:
                // No adjustment for maintaining weight
                break;
        }

        // Macro calculation (typical ranges; these could be adjusted based on specific needs)
        // Protein: 1.2 - 2.0 grams per kg body weight
        // Fat: 20% - 35% of total calories
        // Carbs: Remaining calories after protein and fat are accounted for

        $proteinPerKg = 1.5; // grams of protein per kg (adjustable)
        $proteinCalories = $proteinPerKg * $weightValue * 4;

        $fatPercentage = 0.3; // 30% of total calories from fat (adjustable)
        $fatCalories = $tdee * $fatPercentage;
        $fatGrams = $fatCalories / 9;

        $carbCalories = $tdee - $proteinCalories - $fatCalories;
        $carbGrams = $carbCalories / 4;

        return response()->json([
            'bmr' => round($bmr, 2),
            'tdee' => round($tdee, 2),
            'protein_grams' => round($proteinPerKg * $weightValue, 2),
            'fat_grams' => round($fatGrams, 2),
            'carb_grams' => round($carbGrams, 2),
        ]);
    }

}