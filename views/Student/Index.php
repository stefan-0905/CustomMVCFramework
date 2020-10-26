
<p>Hello students</p>

<?php

if(isset($students))
{
    foreach($students as $student)
    {
        echo "<p>$student->name</p>";
    }
}



?>