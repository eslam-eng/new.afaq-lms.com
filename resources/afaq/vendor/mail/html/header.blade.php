<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{asset('AFAQ.png')}}" class="logo" alt="AFAQ Logo">
@else
<img src="{{asset('AFAQ.png')}}" class="logo" alt="{{ $slot }}">

@endif
</a>
</td>
</tr>
