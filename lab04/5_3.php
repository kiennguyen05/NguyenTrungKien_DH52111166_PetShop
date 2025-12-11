<?php 
$questions = array(
    array(
        'question' => 'Câu 1: Hàm số nào sau đây là hàm bậc nhất?',
        'options' => array(
            'A' => 'f(x) = x^2 + 2x',
            'B' => 'f(x) = 3x + 5',
            'C' => 'f(x) = x^3',
            'D' => 'f(x) = 5x^2'
        ),
        'correct' => 'B'
    ),
    array(
        'question' => 'Câu 2: 2 + 2 bằng bao nhiêu?',
        'options' => array(
            'A' => '3',
            'B' => '4',
            'C' => '5',
            'D' => '6'
        ),
        'correct' => 'B'
    ),
    array(
        'question' => 'Câu 3: Ai là tổng thống đầu tiên của Mỹ?',
        'options' => array(
            'A' => 'George Washington',
            'B' => 'Abraham Lincoln',
            'C' => 'Thomas Jefferson',
            'D' => 'John Adams'
        ),
        'correct' => 'A'
    ),
    array(
        'question' => 'Câu 4: Màu sắc của bầu trời là gì?',
        'options' => array(
            'A' => 'Đỏ',
            'B' => 'Xanh',
            'C' => 'Vàng',
            'D' => 'Đen'
        ),
        'correct' => 'B'
    ),
    array(
        'question' => 'Câu 5: Việt Nam giành được độc lập vào năm nào?',
        'options' => array(
            'A' => '1945',
            'B' => '1954',
            'C' => '1975',
            'D' => '1989'
        ),
        'correct' => 'A'
    )
);

$m=3;
if($m>count($questions)){
    echo"Số câu hỏi cần chọn phải nhỏ hơn hoặc bằng tổng số câu hỏi trong danh sách.";
}

$randomKeys=array_rand($questions,$m);

echo "<h2>Đề Thi Trắc Nghiệm</h2>";
echo "<form method='post'>";

foreach ($randomKeys as $key) {
    $question = $questions[$key];
    echo "<fieldset>";
    echo "<legend>" . $question['question'] . "</legend>";

    foreach ($question['options'] as $option => $answer) {
        echo "<input type='radio' name='question_$key' value='$option' id='question_{$key}_$option'>
              <label for='question_{$key}_$option'>$option. $answer</label><br>";
    }
    
    echo "</fieldset>";
}

echo "<input type='submit' value='Nộp Đề Thi'>";
echo "</form>";


?>