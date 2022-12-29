<?php
$json = '{
    "quiz": {
        "sport": {
            "q1": {
                "question": "Which one is a correct team name in the NBA?",
                "options": [
                    "New York Bulls",
                    "Los Angeles Kings",
                    "Gem State Warriors",
                    "Houston Rockets"
                ],
                "answer": "Houston Rocket"
            }
        },
        "math": {
            "q1": {
                "question": "5 + 7 = ?",
                "options": [
                    "10",
                    "11",
                    "12",
                    "13"
                ],
                "answer": "12"
            },
            "q2": {
                "question": "12 - 8 = ?",
                "options": [
                    "1",
                    "2",
                    "3",
                    "4"
                ],
                "answer": "4"
            }
        }
    }
}';
$quiz = json_decode($json,true);
// print_r($quiz);
$question1 = $quiz['quiz']['sport']['q1'];

print $question1['question'];
print "<br><select><option> choose one </option>";
foreach($question1['options'] as $key=>$value){
    print "<option value='$value'>$value</option>";
}
print '</select><br>';
foreach($quiz['quiz']['math'] as $value){
    print $value['question'];
    print "<br><select><option> choose one </option>";
    foreach($value['options'] as $key=>$value){
        print "<option value='$value'>$value</option>";
    }
    print "</select><br>";
}
?>


<!-- <select name="color" id="color">
	<option value="">--- Choose a color ---</option>
	<option value="red">Red</option>
	<option value="green">Green</option>
	<option value="blue">Blue</option>
</select> -->