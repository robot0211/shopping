@extends('layouts.home')

@section('title')
<title>Home | NPC-Shop</title>
@endsection

@section('css')
<link href="{{ asset('shops/home/home.css') }}" rel="stylesheet">
<style>
    /* Font chữ */
body {
    font-family: 'Roboto', sans-serif;
}

/* Style cho mỗi phần của trang "About Us" */
.about-section,
.mission-section,
.team-section,
.goal-section,
.contact-section {
    padding: 60px 0;
}

.container {
    max-width: 960px;
    margin: 0 auto;
    padding: 0 15px;
}

h2,
h3 {
    color: #333;
    font-weight: 700;
}

p {
    color: #666;
    line-height: 1.6;
}

/* Style cho tiêu đề của mỗi phần */
h2 {
    font-size: 32px;
    margin-bottom: 30px;
    text-align: center;
}

h3 {
    font-size: 24px;
    margin-bottom: 20px;
}

/* Style cho nội dung của mỗi phần */
p {
    font-size: 16px;
    margin-bottom: 20px;
}

/* Hiệu ứng hover cho liên kết */
a {
    color: #007bff;
    transition: color 0.3s ease;
    text-decoration: none;
}

a:hover {
    color: #0056b3;
}

/* Style cho nền và border của mỗi phần */
.about-section,
.mission-section,
.team-section,
.goal-section,
.contact-section {
    background-color: #f9f9f9;
    border-radius: 10px;
    border: 1px solid #ccc;
}

/* Hiệu ứng cho các phần */
.about-section,
.mission-section,
.team-section,
.goal-section,
.contact-section {
    transform: scale(1);
    opacity: 1;
    transition: transform 0.3s ease, opacity 0.3s ease;
}

/* Hiệu ứng hover cho các phần */
.about-section:hover,
.mission-section:hover,
.team-section:hover,
.goal-section:hover,
.contact-section:hover {
    transform: scale(1.05);
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
}

/* Hiệu ứng cho nút */
.btn {
    display: inline-block;
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.btn:hover {
    background-color: #0056b3;
}

</style>
@endsection

@section('js')
<link href="{{ asset('shops/home/home.js') }}" rel="stylesheet">
@endsection


@section('content')

<div class="about-section">
    <div class="container">
        <h2>Chào mừng đến với chúng tôi</h2>
        <p>Chúng tôi là NPC Shop, một điểm đến lý tưởng cho những người yêu thời trang và phong cách. Tại đây, chúng tôi cung cấp một bộ sưu tập đa dạng các sản phẩm thời trang từ các nhãn hiệu hàng đầu trong và ngoài nước.</p>
    </div>
</div>

<div class="mission-section">
    <div class="container">
        <h3>Sứ mệnh của chúng tôi</h3>
        <p>Với sứ mệnh làm nổi bật vẻ đẹp và phong cách của từng cá nhân, chúng tôi cam kết mang lại cho khách hàng những trải nghiệm mua sắm thú vị và đáng nhớ nhất. Không chỉ cung cấp các sản phẩm chất lượng và đa dạng, chúng tôi còn tạo ra một không gian mua sắm thoải mái và thân thiện.</p>
    </div>
</div>

<div class="team-section">
    <div class="container">
        <h3>Đội ngũ của chúng tôi</h3>
        <p>Đội ngũ chuyên nghiệp và nhiệt huyết của chúng tôi luôn sẵn lòng hỗ trợ và tư vấn cho bạn trong việc lựa chọn những sản phẩm phù hợp nhất với phong cách và nhu cầu của bạn. Với sự hiểu biết sâu sắc về thị trường thời trang, chúng tôi cam kết mang lại cho bạn những gợi ý và lời khuyên tốt nhất.</p>
    </div>
</div>

<div class="goal-section">
    <div class="container">
        <h3>Mục tiêu của chúng tôi</h3>
        <p>Chúng tôi không chỉ là một cửa hàng thời trang đơn thuần, mà còn là điểm đến của sự tự tin và phong cách. Mục tiêu của chúng tôi là tạo ra một cộng đồng thời trang mạnh mẽ, nơi mọi người có thể tìm thấy sự tự tin và cá nhân hóa trong cách ăn mặc của mình.</p>
    </div>
</div>

<div class="contact-section">
    <div class="container">
        <h3>Liên hệ với chúng tôi</h3>
        <p>Nếu bạn có bất kỳ câu hỏi hoặc yêu cầu nào, đừng ngần ngại liên hệ với chúng tôi. Đội ngũ hỗ trợ của chúng tôi luôn sẵn lòng giúp đỡ bạn.</p>
        <p>Hãy đến và khám phá thế giới thời trang tại NPC Shop ngay hôm nay!</p>
    </div>
</div>

@endsection