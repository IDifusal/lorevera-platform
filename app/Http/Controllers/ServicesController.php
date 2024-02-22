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
}