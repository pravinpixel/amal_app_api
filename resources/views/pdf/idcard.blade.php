<!DOCTYPE html>
<html>

<head>
    <title>Student ID Card</title>
    <style>
        .footer {
            font-size: 1rem;
            padding: 1rem;
            background-color: rgb(20, 65, 119);
            color: white;
            display: flex;
            flex-direction: column;
            align-items: left;
            text-align: left;
        }

        .margin-top {
            margin-top: 1.25rem;
        }
    </style>
</head>

<body>
    <h1>{{ $student->name }}</h1>
    <p>{{ $student->course }}</p>
    <div class="footer margin-top" style="display: flex; flex-direction: row;">
        <div style="flex: 1;"><img alt="Logo" src="assets/images/Group.png" style="float: left;" /></div>
        <div style="flex: 2; text-align: left;">
            <h2>AMALORPAVAM SCHOOL</h2>
            <h4>Alumini Assosiation!</h4>
        </div>
    </div>
</body>

</html>
