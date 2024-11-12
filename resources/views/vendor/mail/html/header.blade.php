<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://localhost/public/img/logo/semboyan.jpeg" class="logo" alt="Semboyan Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
