<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                <img src="{{ asset('logo-afaq.png') }}" class="logo" alt="SNA Logo">
            @else
                <img src="{{ asset('logo-afaq.png') }}" class="logo" alt="{{ $slot }}">
            @endif
        </a>
    </td>
</tr>
