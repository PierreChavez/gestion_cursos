<!DOCTYPE html>
<html>
<head>
    <title>Certificate</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }
        .certificate {
            text-align: center;
            border: 10px solid #ddd;
            padding: 50px;
        }
        .certificate h1 {
            font-size: 50px;
        }
        .certificate p {
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="certificate">
        <h1>Certificate of Completion</h1>
        <p>This is to certify that</p>
        <h2>{{ $student->name }}</h2>
        <p>has successfully completed the course</p>
        <h2>{{ $course->name }}</h2>
        <p>with a grade of {{ $grade->grade }} and an attendance of {{ ($attendance->attended_classes / $attendance->total_classes) * 100 }}%.</p>
    </div>
</body>
</html>
