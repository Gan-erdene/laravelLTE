@if($rate)
<i @if($rate >= 1)style="color:#2dc3e8" @endif data-userid="{{$user_id}}" data-propid="{{$pid}}" data-id="1" class="fa fa-star fa-lg setrate"></i>
<i @if($rate >= 2)style="color:#2dc3e8" @endif data-userid="{{$user_id}}" data-propid="{{$pid}}" data-id="2" class="fa fa-star fa-lg setrate"></i>
<i @if($rate >= 3)style="color:#2dc3e8" @endif data-userid="{{$user_id}}" data-propid="{{$pid}}" data-id="3" class="fa fa-star fa-lg setrate"></i>
<i @if($rate >= 4)style="color:#2dc3e8" @endif data-userid="{{$user_id}}" data-propid="{{$pid}}" data-id="4" class="fa fa-star fa-lg setrate"></i>
<i @if($rate >= 5)style="color:#2dc3e8" @endif data-userid="{{$user_id}}" data-propid="{{$pid}}" data-id="5" class="fa fa-star fa-lg setrate"></i>
@else
<i data-propid="{{$pid}}" data-id="1" class="fa fa-star fa-lg setrate"></i>
<i data-propid="{{$pid}}" data-id="2" class="fa fa-star fa-lg setrate"></i>
<i data-propid="{{$pid}}" data-id="3" class="fa fa-star fa-lg setrate"></i>
<i data-propid="{{$pid}}" data-id="4" class="fa fa-star fa-lg setrate"></i>
<i data-propid="{{$pid}}" data-id="5" class="fa fa-star fa-lg setrate"></i>
@endif
