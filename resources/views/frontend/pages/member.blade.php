@extends('layouts.frontend')
@section('javascripts')
<link href="/frontend/assets/css/timeline.css" rel="stylesheet">
<script>
$(document).ready(function(){
  $('#page_{{$_page}}').addClass('active');
});
</script>
@endsection
@section('content')
<div class="container page-content">
  <div class="row">
    <div class="col-md-3">
      @include('frontend.pages.menu')
    </div>
    <div class="col-md-9">
      <div class="widget">
            <div class="widget-body">
                <div class="expand_container">
                  <h5>ГИШҮҮНЧЛЭЛИЙН АНГИЛАЛ</h5>
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Гишүүнчлэл</th>
                        <th class="text-center">FREE</th>
                        <th class="text-center">BASIC</th>
                        <th class="text-center">PREMIUM</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="table-info">
                        <td>Өөрийгөө сурталчилах</td>
                        <td class="text-center">*</td>
                        <td class="text-center">*</td>
                        <td class="text-center">*</td>
                      </tr>
                      <tr>
                        <td>Нийгмийн даатгал</td>
                        <td></td>
                        <td class="text-center">*</td>
                        <td class="text-center">*</td>
                      </tr>
                      <tr class="table-success">
                        <td>Эрүүл мэндийн даатгал</td>
                        <td></td>
                        <td class="text-center">*</td>
                        <td class="text-center">*</td>
                      </tr>
                      <tr>
                        <td>Банкны үйлчилгээ</td>
                        <td></td>
                        <td class="text-center">*</td>
                        <td class="text-center">*</td>
                      </tr>
                      <tr>
                        <td>Сургалтын байгууллагын хөнгөлөлт</td>
                        <td></td>
                        <td></td>
                        <td class="text-center">*</td>
                      </tr>
                      <tr>
                        <td>Мэргэжлийн хариуцлагын даатгал</td>
                        <td></td>
                        <td></td>
                        <td class="text-center">*</td>
                      </tr>
                      <tr>
                        <td>Төлбөр</td>
                        <td class="text-center">Үнэгүй</td>
                        <td class="text-center">2,000 төгрөг</td>
                        <td class="text-center">5,000 төгрөг</td>
                      </tr>
                    </tbody>
                  </table>
                  <p>*Банкны картын үйлчилгээний хугацаа хамгийн багадаа 1 жил байна. </p>
                  <p><b>Free</b> гишүүнчлэлийг сонгосноор зөвхөн www.EZN.mn цамим сүлжээнд өөрийн ур чадварыг үнэ төлбөргүй сурталчлах боломжтой.</p>
                  <p>
                    <b>Basic</b> гишүүнчлэлийг сонгосноор:
                    <ul>
                      <li>EZN.mn-д өөрийн ур чадварыг сурталчилна;</li>
                      <li>Нийгмийн даатгал, эрүүл мэндийн даатгалд хамрагдана. EZNetwork төсөл хэрэгжүүлэгч нийгмийн даатгалын дэвтэр, эрүүл мэндийн даатгалын дэвтэр үнэ төлбөргүй нээж өгнө. Нийгмийн даатгал, эрүүл мэндийн даатгалын шимтгэл төлснөөр холбогдох нийгмийн халамж, үйлчилгээг авах боломжтой болохоос гадна хөдөлмөрийн түүх үүсэх юм;</li>
                      <li>Банкны үйлчилгээнд EZCard буюу цалин, төлбөрийн цахим картыг хамтран ажиллагч банк үнэ төлбөргүй нээж өгнө. Мөн банкнаас төсөлд хамрагдсан оюутан, залууст зориулан гаргасан зээлийн тусгай хөтөлбөрийн үйлчилгээг авах боломжтой.</li>
                    </ul>
                  </p>
                  <p>
                    <b>Premium</b> гишүүнчлэлийг сонгосноор <b>Basic</b> гишүүнчлэлийн бүх хөтөлбөрт хамрагдахаас гадна:
                    <ul>
                      <li>Төсөлд хамтран ажиллагч гэрээт сургалтын төвийн сургалтанд хөнгөлөлттэй үнээр суралцах боломжтой;</li>
                      <li>Мэргэжлийн хариуцлагын 1 жилийн даатгалд үнэ төлбөргүй хамрагдана. Энэ нь ажлын хариуцлагын эрсдэлээс хамгаалах юм.</li>
                    </ul>
Төлбөр, хураамжтай Basic, Premium гишүүнчлэлд хамрагдсан оюутан, залууст банкны EZCard  буюу цалин, төлбөрийн картыг үнэ төлбөргүй нээхэд үйлчилгээний хугацаа нь 1 жил байдаг тул Basic, Premium гишүүнчлэлд элсэхэд гэрээгээ 1 жилийн хугацаатай хийнэ.
                  </p>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection
