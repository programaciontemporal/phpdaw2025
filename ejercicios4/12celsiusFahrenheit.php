<?php
function celsiusToFahrenheit($celsius) {
    return ($celsius * 9/5) + 32;
}

echo "30°C en Fahrenheit es: " . celsiusToFahrenheit(30) . "ºF";
?>
