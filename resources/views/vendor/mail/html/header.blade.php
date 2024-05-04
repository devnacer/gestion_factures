@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Invoice Master')
<img src="{{ URL::asset('assets/img/logoInvoiceMaster.png') }}" class="logo" alt="Invoice Master Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
