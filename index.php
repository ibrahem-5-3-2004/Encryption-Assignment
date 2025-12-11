<?php

$encryption_key = hash('sha256', 'MySuperSecretKey123');

$iv = substr(hash('sha256', 'MySecretIV456'), 0, 16);
$cipher_algo = "AES-256-CBC";

$output_text = "";
$input_text = "";
$action_type = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_text = $_POST['user_text'] ?? '';


    if (isset($_POST['encrypt_btn'])) {
        $encrypted = openssl_encrypt($input_text, $cipher_algo, $encryption_key, 0, $iv);

        $output_text = $encrypted;
        $action_type = "encrypted text (Encrypted - Base64):"; // 
    } elseif (isset($_POST['decrypt_btn'])) {

        $decrypted = openssl_decrypt($input_text, $cipher_algo, $encryption_key, 0, $iv);
        $output_text = $decrypted;
        $action_type = "The text after decryption (Decrypted):"; // 
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AES Encryption Assignment</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            padding-top: 50px;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 500px;
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        textarea {
            width: 100%;
            height: 100px;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            resize: vertical;
        }

        .btn-group {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        input[type="submit"] {
            flex: 1;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            color: white;
            font-weight: bold;
            transition: background 0.3s;
        }

        .btn-encrypt {
            background-color: #28a745;
        }

        .btn-encrypt:hover {
            background-color: #218838;
        }

        .btn-decrypt {
            background-color: #007bff;
        }

        .btn-decrypt:hover {
            background-color: #0069d9;
        }

        .result-box {
            margin-top: 20px;
            text-align: right;
            background: #e9ecef;
            padding: 15px;
            border-radius: 4px;
            border: 1px dashed #ccc;
        }

        .label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            text-align: right;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Cryptography duty AES-256</h2>

        <form method="post" action="">
            <label for="text" class="label">Enter the text here:</label>
            <textarea name="user_text" id="text" placeholder="اكتب النص المراد تشفيره أو النص المشفر لفك تشفيره..."><?php echo htmlspecialchars($input_text); ?></textarea>

            <div class="btn-group">
                <input type="submit" name="encrypt_btn" value="تشفير" class="btn-encrypt">
                <input type="submit" name="decrypt_btn" value="فك تشفير" class="btn-decrypt">
            </div>
        </form>

        <?php if (!empty($output_text)): ?>
            <div class="result-box">
                <strong><?php echo $action_type; ?></strong>
                <p style="word-break: break-all; color: #d63384; direction: ltr; text-align: left;">
                    <?php echo htmlspecialchars($output_text); ?>
                </p>
            </div>
        <?php endif; ?>
    </div>

</body>

</html>