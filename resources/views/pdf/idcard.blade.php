<!DOCTYPE html>
<html>

<head>
    <title>Student ID Card</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <style type="text/css">
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
    @php
        $image = $student->image ?? '';
    @endphp
</head>





<img src="{{$image }}" height="100" width="100" />



<body class="border">

    <div style="display: flex; flex-direction: column; gap: 1rem">
        <div style=" display: flex; flex-direction: row; gap: 1rem">
            <div><img alt="Logo" src="assets/images/Frame 24.png"
                    style="float: left;width: 100px; padding-left: 40px;" /></div>
            <div style=" text-align: center;padding-left: 20px;padding-top: 50px;">
                <div style="display: flex; flex-direction: row;">
                    <img alt="Logo" src="assets/images/Frame 7.png" style="width: 50px;" />
                    <img alt="Logo" src="assets/images/Frame 7.png" style="width: 50px;" />
                </div>

                <img src="https://testimonial-api.designonline.in/storage/customer/image_66a36545056ec_1721984325.png"
                    style="width: 400px;  object-fit: cover;" />
                <h1 style="color: rgb(20, 65, 119);">{{ $student->name }}</h1>
                <p>DOB:{{ $student->dob }}</p>
            </div>
        </div>


        <div class="footer " style="display: flex; flex-direction: row; gap: 1rem">
            <div><img alt="Logo" src="assets/images/Frame 7.png" style="float: left;width: 150px;" /></div>
            <div style=" text-align: left;padding-left: 20px;">
                <h2>AMALORPAVAM SCHOOL</h2>
                <h4 style="margin-top: -1.5rem;">Alumini Assosiation!</h4>
            </div>
        </div>
    </div>

</body>

</html>
