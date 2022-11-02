<body onLoad="createQr();">
    <img src='https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=bernard' width='100' style='position:fixed; left:50px;'>
    <div style='text-align: center;'>
        Republic of the Philippines<br>
        City of <?=$bgycity?><br>
        <h1>Barangay <?=$bgyname?></h1>
    </div>

    <hr style="margin: 0 40px;">

    <br>
    <div style='text-align: center;'>
    <h3>OFFICE OF THE BARANGAY CAPTAIN</h3>
    <h1>CERTIFICATE OF INDIGENCY</h1>
    </div>
    <br><br>
    <div style='margin: 0 40px; line-height:200%; text-align: justify;'>
        <b>TO WHOM IT MAY CONCERN:</b>
        <p style='text-indent: 50px;'>
        This is to certify that <?=$senderName?>, <?=$age?> years old, <?=$nationality?> Citizen, and belongs to the indigent family of
        Barangay <?=$bgyname?>, <?=$bgycity?>. 
        </p>
        <p style='text-indent: 50px;'>
        This certification is being issued upon the request of the above-named person for whatever legal purpose it may serve him best.
        </p>
        <p style='text-indent: 50px;'>
        <b>ISSUED</b> this <?=$day?> of <?=$month?>, <?=$year?> at the office of the Punong Barangay, Barangay <?=$bgyname?>, <?=$bgycity?> City, Philippines.
        </p>
    </div>
    <br><br><br>

    <div style='margin: 0 40px;'>
        <div style='width:27%;float:right;'>
            <p><b><?=$chname?></b><br>Barangay Captain</p>
        </div>
    </div>
    <br><br><br><br><br><br><br>

    <div class="container" style="align-items: center; justify-content:center;display:flex; width:160px; height:160px; border: 2px solid black;">
        <img src="" alt="" id='img'>
    </div>
    <script>
        function createQr() {
            let txt = document.getElementById('qr-text').value;
            document.getElementById('img').src = 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=txt';
        }
    </script>

    <div style='margin: 0 40px;'>
        O.R. No. <?=$requestID?> <br>
        Date Issued: <?=$full_date?><br>
        Doc. Stamp: paid
    </div>
</body>
