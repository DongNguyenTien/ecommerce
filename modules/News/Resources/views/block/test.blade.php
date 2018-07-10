@extends('layouts.admin_default')
@section('title','test')
@section('content')
    {!! $block->data !!}
    <h1>Tìm hiểu các công ty liên quan </h1>
    <ul>
        <li class="wipro">
            <a href="//www.wcclg.com" target="_blank"><div class="logo"></div></a>
            <p>Tập đoàn Sản phẩm tiêu dùng & Hệ thống chiếu sáng Wipro (WCCLG) hiện có mặt trên 50 quốc gia và phát triển mạnh mẽ tại khu vực châu Á và Trung Đông với những thương hiệu hàng đầu.  Đối với phân khúc khách hàng doanh nghiệp tại Ấn Độ, WCCLG đã và đang khẳng định vị trí dẫn đầu với các sản phẩm chiếu sáng và Nội thất văn phòng.
            </p>
        </li>
        <li class="yardley">
            <a href="//yardleylondon.co.uk" target="_blank"><div class="logo"></div></a>
            <p>Yardley of London là một trong những thương hiệu danh tiếng lâu đời bậc nhất trên thế giới. Là niềm tự hào của nước Anh với hơn 240 năm kinh nghiệm chuyên sâu trong lĩnh vực sản xuất nước hoa và các sản phẩm chăm sóc cá nhân chiết xuất đa dạng từ các loài hoa nổi tiếng với chất lượng tuyệt hảo. </p>
        </li>
        <li class="ldwaxson">
            <div class="logo"></div>
            <p>Tập đoàn L.D Watson sở hữu bộ danh mục các thương hiệu nổi tiếng phục vụ đa dạng nhu cầu người tiêu dùng như chăm sóc da với Bio-essence, Ginvera và Syahirah và chăm sóc sức khoẻ với thương hiệu Ebene. L.D Waxson đã tạo dựng cho mình vị trí dẫn đầu tại thị trường Singapore và đạt những thành công ấn tượng tại khu vực Đông Nam Á.  </p>
        </li>
        <div style="clear: both;"></div>
    </ul>








@endsection