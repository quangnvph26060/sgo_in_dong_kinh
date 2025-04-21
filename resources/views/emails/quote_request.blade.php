<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Quotation Request Notification</title>
    <style>
        /* Reset styles */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
        }

        table {
            border-spacing: 0;
            width: 100%;
        }

        td,
        th {
            padding: 0;
        }

        img {
            border: 0;
            display: block;
        }

        /* Main container */
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Header */
        .header {
            background-color: #007bff !important;
            padding: 20px !important;
            text-align: center !important;
            color: #ffffff !important;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        /* Content */
        .content {
            padding: 30px;
            color: #333333;
        }

        .content h2 {
            font-size: 20px;
            margin-top: 0;
        }

        .content p {
            font-size: 16px;
            line-height: 1.5;
            margin: 10px 0;
        }

        .request-details {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 6px;
            margin-top: 20px;
        }

        .request-details p {
            margin: 8px 0;
            font-size: 15px;
        }

        .request-details strong {
            color: #007bff;
        }

        /* Button */
        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #007bff;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 4px;
            font-size: 16px;
            margin: 20px 0;
            text-align: center;
        }

        /* Footer */
        .footer {
            background-color: #f4f4f4;
            padding: 20px;
            text-align: center;
            font-size: 14px;
            color: #666666;
        }

        .footer a {
            color: #007bff;
            text-decoration: none;
        }

        /* Responsive */
        @media only screen and (max-width: 600px) {
            .container {
                width: 100%;
                border-radius: 0;
            }

            .content {
                padding: 20px;
            }

            .header h1 {
                font-size: 20px;
            }

            .content h2 {
                font-size: 18px;
            }

            .button {
                width: 100%;
                box-sizing: border-box;
            }
        }
    </style>
</head>

<body>
    <table role="presentation" class="container">
        <!-- Header -->
        <tr>
            <td class="header">
                <h1>Yêu cầu báo giá mới</h1>
            </td>
        </tr>
        <!-- Content -->
        <tr>
            <td class="content">
                <h2>Chào Admin,</h2>
                <p>Một yêu cầu báo giá mới đã được gửi và cần sự chú ý của bạn. Dưới đây là thông tin chi tiết về yêu
                    cầu:</p>
                <div class="request-details">
                    <p><strong>Họ và tên:</strong> {{ $data['name'] }}</p>
                    <p><strong>Email:</strong> {{ $data['email'] }}</p>
                    <p><strong>Số điện thoại:</strong> {{ $data['phone'] }}</p>
                    <p><strong>Ghi chú:</strong> {{ $data['notes'] ?? $data['message'] }}</p>
                    @if (isset($data['productName']))
                        <p><strong>Sản phẩm:</strong> {{ $data['productName'] }}</p>
                    @endif
                </div>
                <p>Vui lòng xem xét yêu cầu và thực hiện hành động phù hợp sớm nhất có thể.</p>
            </td>
        </tr>
        <!-- Footer -->
        <tr>
            <td class="footer">
                <p>Thank you for your attention.<br>
                    [Your Company Name] | <a href="[Your Website URL]">Visit our website</a></p>
                <p>If you have any questions, please contact us at <a href="mailto:[Support Email]">[Support Email]</a>.
                </p>
            </td>
        </tr>
    </table>
</body>

</html>
