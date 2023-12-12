<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Sekolahku</title>
</head>

<body>
    <!-- //hero -->
    <section>
        <div class="container">
            <div class="row mt-4 ">
                <div class="col-md-12 text-center mb-3">
                    <h1 class="fw-bold">SELAMAT DATANG</h1>

                </div>
                <div class="col-md-12 text-start mb-3">
                    <h1 class="fw-bold">Note Jawaban</h1>
                    <p>
                        //Soal A no 4 <br>
                        //Tampilsemua data dengan JOIN <br>
                        SELECT users.id as id,users.username as username , course,mentor,title FROM users JOIN usercourse on users.id = usercourse.id_user JOIN courses on courses.id = usercourse.id_course;
                    </p>
                    <p>


                        //Soal A no 5 <br>
                        // yg title mentor nya S Sarjana menggunakan LIKE<br>
                        SELECT users.id as id,users.username as username , course,mentor,title FROM users JOIN usercourse on users.id = usercourse.id_user JOIN courses on courses.id = usercourse.id_course WHERE title LIKE 'S%';
                    </p>
                    <p>

                        //Soal A no 6<br>
                        //yg mentornya bertitle selain sarjana menggunakan NOT LIKE<br>
                        SELECT users.id as id,users.username as username , course,mentor,title FROM users JOIN usercourse on users.id = usercourse.id_user JOIN courses on courses.id = usercourse.id_course WHERE title NOT LIKE 'S%';
                    </p>
                    <p>

                        //Soal A no 7<br>
                        // jumlah peserta tiap courses<br>
                        SELECT DISTINCT course,mentor,title,count(*) AS jumlah_peserta FROM usercourse JOIN courses on courses.id = usercourse.id_course WHERE usercourse.id_course = courses.id GROUP by courses.course;
                    </p>
                    <p>

                        //Soal A no 8<br>
                        //menampilkan total fee mentor 2000k per peserta didik<br>
                        SELECT DISTINCT mentor,count(*) AS jumlah_peserta, sum(2000000) AS total_fee FROM usercourse JOIN courses on courses.id = usercourse.id_course WHERE usercourse.id_course = courses.id GROUP by courses.mentor;
                    </p>
                    <p>

                        //Soal B no 1<br>
                        CRUD Users<br>
                        http://localhost:8080/users<br>
                        ->key => username,email,password<br>
                        CRUD<br>
                        http://localhost:8080/courses<br>
                        ->key => course , mentor,title<br>
                        CRUD<br>
                        http://localhost:8080/usercourse<br>
                        ->key => id_user,id_course //(belum di ubah)<br>
                    </p>
                    <p>


                        //API Soal B no 4 API untuk Soal A 5,6,7,8<br>
                        //tampilsemua<br>
                        -> http://localhost:8080/sekolahku/<br>
                        //hanya sarjana<br>
                        -> http://localhost:8080/sekolahku/?fungsi=sarjana<br>
                        //hanya selain sarjana<br>
                        -> http://localhost:8080/sekolahku/?fungsi=notsarjana<br>
                        //menampilkan Jumlah murid tiap course<br>
                        -> http://localhost:8080/sekolahku/?fungsi=jumlahmurid<br>
                        //menampilkan Jumlah fee mentor<br>
                        -> http://localhost:8080/sekolahku/?fungsi=fee<br>


                    </p>

                </div>

            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>