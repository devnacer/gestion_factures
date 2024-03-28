@props(['typeAlert'])
<div class="alert alert-{{$typeAlert}}" role="alert">
    <strong>{{$slot}}</strong>
</div>