<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>

    <link rel="stylesheet" href="css/style.css">
    <script src="js/app.js"></script>
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
include "layout.php";
?>

<div class="content">

    <div align="center">
        <form style="width: 60%">
            <div>
                <label>Car Mechanic Booking Panel</label><hr style="width: 250px; border: 1px solid #897052">
                <input id="name" type="text" placeholder="Client Name" required>
                <input id="address" type="text" placeholder="Client Address" required>
                <input id="cellnum" type="text" placeholder="Client Cell Number" required>
                <input id="license" type="text" placeholder="Car License Number" required>
                <input id="engine" type="text" placeholder="Car Engine Number" required>
                <div class="flex-row-nowrap">
                    <div class="flex-row-nowrap">
                        <label align="left">Appointment Date</label>
                    </div>
                    <input id="appointment" type="date" placeholder="date" required>
                </div>



                <select id="mechanic">
                    <option value="NotSelected" selected disabled>Select from available Mechanic</option>
                    <?php
                    $sql = "SELECT * FROM mechanics";
                    $result=mysqli_query($db, $sql);
                    while($data = mysqli_fetch_assoc($result)){
                        ?>
                        <option value="<?php echo $data['name'] ?>"> <?php echo $data['name'] ?></option>
                        <?php
                    }
                    ?>
                </select>
                <button onclick="book()" class="button button3" type="button">Submit</button><br>
                <span class="notifier" id="request" style="color: #80cbc4">Processing Request..</span><br>
                <span class="notifier" id="success" style="color: #aed581">Booking Successful..</span><br>
                <span class="notifier" id="failed" style="color: #DA0037">Booking Failed..</span><br>

                <span class="notifier" id="msg" style="color: #ffd54f">Load MSG</span><br>

            </div>
        </form>
    </div>

</div>

<div class="footer">
    <p>2021 | CMS Panel | MechaBook</p>
</div>

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