@extends('layouts.home')

@section('title')
<title>Home | NPC-Shop</title>
@endsection

@section('css')
<link href="{{ asset('shops/home/home.css') }}" rel="stylesheet">
<style>
    .container {
            max-width: 960px;
            margin: 0 auto;
            padding: 20px;
        }

        h2 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 20px;
        }

        .contact-info {
            margin-bottom: 30px;
        }

        .form-container {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }
</style>
@endsection

@section('js')
<link href="{{ asset('shops/home/home.js') }}" rel="stylesheet">
@endsection


@section('content')

<div class="container">
    <h1>Liên hệ</h1>
</div>

<div class="container">
    <h2>Thông tin Liên hệ</h2>
    <div class="contact-info">
        <p><strong>Địa chỉ:</strong> Học viện kỹ thuật mật mã</p>
        <p><strong>Điện thoại:</strong> 0987654321</p>
        <p><strong>Email:</strong> nguyentanphat@gmail.com</p>
    </div>
    <h2>Hỗ trợ khách hàng</h2>
    <div class="contact-info">
        <p><strong>Email:</strong> npcshop123@gmail.com</p>
        <p><strong>Số điện thoại:</strong> 0987654321</p>
        <p><strong>Giờ làm việc:</strong> Thứ Hai đến Thứ Sáu, từ 9:00 sáng đến 5:00 chiều.</p>
    </div>
    <h2>Form Liên hệ</h2>
    <div class="form-container">
        <form action="#" method="POST">
            <div class="form-group">
                <label for="name">Họ và tên:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="message">Tin nhắn:</label>
                <textarea id="message" name="message" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="Gửi">
            </div>
        </form>
    </div>
</div>

@endsection