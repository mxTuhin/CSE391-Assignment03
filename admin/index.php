<?php
session_start();
$session = $_SESSION['logged_in'];
?>
<html lang="en">
<head>
    <meta charset="utf-8"/>

    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/app.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
          integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
          crossorigin="anonymous"
          referrerpolicy="no-referrer" />
    <style>
        .notifier{
            display: none;
        }
    </style>
</head>
<body>

<?php
include "../layout.php";
?>


<?php
if($session){
?>
<div id="content_tag" class="content">
    <div align="center">

        <span class="notifier" id="request" style="color: #80cbc4">Processing Request..</span><br>
        <span class="notifier" id="success" style="color: #aed581">Process Successful</span><br>
        <span class="notifier" id="failed" style="color: #DA0037">Process Failed..</span><br>

        <span class="notifier" id="msg" style="color: #ffd54f">Load MSG</span><br>

        <h2 style="text-align: center">Booking List</h2><hr style="width: 300px; border: 1px solid #897052">
        <table style="margin-bottom: 100px">
            <thead>
            <tr>
                <th>#</th>
                <th>Client Name</th>
                <th>Cell Number</th>
                <th>Engine Number</th>
                <th>Appointment Date</th>
                <th>Mechanic Name</th>
                <th>Action</th>

            </tr>
            </thead>
            <?php
            $i=1;
            $sql = "SELECT * FROM booking";
            $result = mysqli_query($db, $sql);
            while ($data=mysqli_fetch_assoc($result)){
            ?>
            <tr id="book<?php echo $data['id'] ?>">
                <td><?php echo $i ?></td>
                <td><?php echo $data['name'] ?></td>
                <td><?php echo $data['cellnum'] ?></td>
                <td><?php echo $data['engine'] ?></td>
                <td><input id="appointment<?php echo $data['id'] ?>" type="date" value="<?php echo $data['appointment'] ?>"></td>
                <td>
                    <select id="mechanic<?php echo $data['id'] ?>" type="select">
                        <?php
                        $sql_in="SELECT * FROM mechanics";
                        $result_in=mysqli_query($db, $sql_in);
                        while ($data_in=mysqli_fetch_assoc($result_in)){
                        ?>
                        <option value="<?php echo $data_in['name'] ?>"  <?php if($data['mechanic']==$data_in['name']) {?> selected<?php } ?> ><?php echo $data_in['name'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <div style="float: left">
                        <button onclick="update_booking(<?php echo $data['id'] ?>)" style="background-color: #18ffff" class="button"><i class="fas fa-edit"></i></button>
                    </div>
                    <div style="float: right">
                        <button onclick="delete_booking(<?php echo $data['id'] ?>)" class="button button3"><i class="fas fa-minus-circle"></i></button>
                    </div>
                </td>

            </tr>
            <?php
                $i++;
            }
            ?>

        </table>
    </div>
</div>
<?php
}else{
    ?>
    <div id="pass" class="content">

        <div align="center">
            <form style="width: 60%">
                <div>
                    <label>Enter 5759 to Login.</label><hr style="width: 250px; border: 1px solid #897052">
                    <input id="pass_c" type="text" placeholder="Enter Secret PassCode. (Help: Password is: 5759)" required>

                    <button onclick="pass_code()" class="button button3" type="button">Submit</button><br>
                    <span class="notifier" id="request" style="color: #80cbc4">Processing Request..</span><br>
                    <span class="notifier" id="success" style="color: #aed581">Login Successful..</span><br>
                    <span class="notifier" id="failed" style="color: #DA0037">Login Failed..</span><br>

                    <span class="notifier" id="msg" style="color: #ffd54f">Load MSG</span><br>

                </div>
            </form>
        </div>

    </div>
<?php
}
?>

<div class="footer">
    <p>2021 | CMS Panel | MechaBook</p>
</div>
<script>

    function update_booking(id){
        var appointment = document.getElementById("appointment"+id).value;
        var mechanic = document.getElementById("mechanic"+id).value;
        console.log(appointment+mechanic);
        const xhttp = new XMLHttpRequest();

        xhttp.onload = function() {
            document.getElementById("success").style.display = "none";
            document.getElementById("failed").style.display = "none";
            document.getElementById("msg").style.display = "none";

            document.getElementById("msg").style.display = "block";
            var data= JSON.parse(this.responseText)
            if(data.error){
                document.getElementById("failed").style.display = "block";
            }else{
                document.getElementById("success").style.display = "block";
            }
            document.getElementById("msg").innerText = data.msg;
            setTimeout(function(){
                document.getElementById("success").style.display = "none";
                document.getElementById("failed").style.display = "none";
                document.getElementById("msg").style.display = "none";
            }, 2000);

            // console.log(this.responseText);
        }
        url="id="+id+"&appointment="+appointment+"&mechanic="+mechanic;
        console.log(url);
        xhttp.open("GET", "update.php?"+url);
        xhttp.send();
    }

    function delete_booking(id){
        document.getElementById("book"+id).style.display = "none";

        const xhttp = new XMLHttpRequest();

        xhttp.onload = function() {
            document.getElementById("success").style.display = "none";
            document.getElementById("failed").style.display = "none";
            document.getElementById("msg").style.display = "none";

            document.getElementById("msg").style.display = "block";
            var data= JSON.parse(this.responseText)
            if(data.error){
                document.getElementById("failed").style.display = "block";
            }else{
                document.getElementById("success").style.display = "block";
            }
            document.getElementById("msg").innerText = data.msg;
            setTimeout(function(){
                document.getElementById("success").style.display = "none";
                document.getElementById("failed").style.display = "none";
                document.getElementById("msg").style.display = "none";
            }, 2000);

            // console.log(this.responseText);
        }
        url="id="+id;
        console.log(url);
        xhttp.open("GET", "delete.php?"+url);
        xhttp.send();
    }

    function pass_code(){
        var pass_c=document.getElementById("pass_c").value;
        const xhttp = new XMLHttpRequest();

        xhttp.onload = function() {
            document.getElementById("success").style.display = "none";
            document.getElementById("failed").style.display = "none";
            document.getElementById("msg").style.display = "none";

            document.getElementById("msg").style.display = "block";
            var data= JSON.parse(this.responseText)
            if(data.error){
                document.getElementById("failed").style.display = "block";
            }else{
                document.getElementById("success").style.display = "block";
            }
            document.getElementById("msg").innerText = data.msg;

            // console.log(this.responseText);
        }
        url="pass_c="+pass_c;
        console.log(url);
        xhttp.open("GET", "pass.php?"+url);
        xhttp.send();
        setTimeout(function(){ window.location.href = "../admin/"; }, 2000);
    }
</script>

<script>

    function book(){
        var name=document.getElementById("name");
        var address=document.getElementById("address");
        var cellnum = document.getElementById("cellnum");
        var license = document.getElementById("license");
        var engine=document.getElementById("engine");
        var appointment=document.getElementById("appointment");
        var mechanic=document.getElementById("mechanic");

        const xhttp = new XMLHttpRequest();

        xhttp.onload = function() {
            document.getElementById("success").style.display = "none";
            document.getElementById("failed").style.display = "none";
            document.getElementById("msg").style.display = "none";

            document.getElementById("msg").style.display = "block";
            var data= JSON.parse(this.responseText)
            if(data.error){
                document.getElementById("failed").style.display = "block";
            }else{
                document.getElementById("success").style.display = "block";
            }
            document.getElementById("msg").innerText = data.msg;

            // console.log(this.responseText);
        }
        var url="name="+name.value+"&address="+address.value+"&cellnum="+cellnum.value+"&license="+license.value+"&engine="+engine.value+"&appointment="+appointment.value+"&mechanic="+mechanic.value;
            console.log(url);
        xhttp.open("GET", "book.php?"+url);
        xhttp.send();

        name.value="";
        address.value="";
        cellnum.value="";
        license.value="";
        engine.value="";
        appointment.value="";
    }
</script>
</body>
</html>