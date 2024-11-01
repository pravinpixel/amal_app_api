<!DOCTYPE html>
<html>

<head>
    <title>Student ID Card</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 96%;
            background-color: rgb(20, 65, 119);
            color: white;
            text-align: center;
            padding: 1rem;
            font-size: 1.5rem;
        }


        .top-content {
            display: flex;
            justify-content: space-between;
        }

        .content {
            display: flex;
            flex-direction: column;
            height: 100vh;
            width: 100vw;
        }

        .border {
            border: 1px solid rgb(20, 65, 119);
            border-radius: 1rem;
        }

        .side-bar {
            background-color: #124191;
            color: #fff;
            transform: rotate(90deg);
            transform-origin: left;
            font-size: 30px;
            padding-top: 30px;
            padding-left: 50px;
            padding-right: 50px;
            text-align: center;
            justify-content: center;
            font-weight: bold;
            height: 70px;
            width: 700px;
        }
    </style>

</head>




<body>
    <div class="border">
        <div style=" display: flex; flex-direction: row; gap: 1rem; height:1000px">
            <div style="float:left"><img alt="Logo" style=" padding-left: 50px;height: 700px;"
                    src="assets/images/Frame 24.png" />
            </div>
            <div style=" text-align: center;">
                <div style="padding-top:90px">
                    <img alt="Logo" src="assets/images/Frame 7.png" style="width: 50px;padding-right: 20px;" />
                    <img alt="Logo" src="assets/images/Frame 7.png" style="width: 50px;padding-left:20px" />
                </div>
                <div>
                    @if(isset($student->image) && !empty($student->image))
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents($student->image)) }}"
                            style="width: 400px;  object-fit: cover; padding-top: 50px;" />
                    @else
                        <img src="assets/images/dummy.png" style="width: 400px;  object-fit: cover; padding-top: 50px;" />
                    @endif
                </div>

                <h1
                    style="color: rgb(20, 65, 119);font-family: 'Excon', 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif">
                    {{ $student->name }}
                </h1>
                <p style="font-family: 'Excon', 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif">
                    DOB:{{ \Carbon\Carbon::parse($student->dob)->format('d M Y') }}</p>
            </div>
        </div>


        <div class="footer " style="display: flex; flex-direction: row; gap: 1rem; height: 200px;">
            <div><img alt="Logo" src="assets/images/Frame 7.png" style="float: left;width: 150px;" /></div>
            <div style=" text-align: left;padding-left: 20px;">
                <h2>AMALORPAVAM SCHOOL</h2>
                <h4 style="margin-top: -1.5rem;">Alumini Assosiation!</h4>
            </div>
        </div>
    </div>

</body>

</html>
