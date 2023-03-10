<x-print-layout>
	{{-- <x-slot name="css">
		<link rel="stylesheet" href="{{ asset('css/print-style.css') }}">
	</x-slot> --}}

	<section class="print-preview-a4">
		<header>
			<x-para-clinic.print-header :row="$row" title="Prescription">
				<tr>
					<td width="15%"><b>Diagnosis</b></td>
					<td colspan="5">: {{ $row->diagnosis }}</td>
				</tr>
			</x-para-clinic.print-header>
		</header>
		<section class="prescription-body">
			<table class="my-2">
				<tr class="text-center">
					<th class="text-center">N&deg;</th>
					<th>Medicine</th>
					<th width="50px">QTY</th>
					<th width="50px">U/D</th>
					<th width="50px">NoD</th>
					<th width="50px">Total</th>
					<th width="50px">Unit</th>
					<th width="160px">Usage Time</th>
					<th>Usage</th>
					<th>Note</th>
				</tr>
				@foreach ($row->detail as $i => $detail)
					<tr>
						<td>{{ str_pad(++$i, 2, '0', STR_PAD_LEFT) }}</td>
						<td>{{ d_obj($detail, 'product', ['name_en', 'name_kh']) }}</td>
						<td>{{ d_number($detail->qty) }}</td>
						<td>{{ d_number($detail->upd) }}</td>
						<td>{{ d_number($detail->nod) }}</td>
						<td>{{ d_number($detail->total) }}</td>
						<td>{{ d_obj($detail, 'unit', ['name_en', 'name_kh']) }}</td>
						<td>
							@php
								$j = 0;
							@endphp
							@foreach ($time_usage as $id => $data)
								@if (in_array($id, explode(',', $detail->usage_times ?? [])))
									@if ($j==0)
										{{ $data }}
										@php
											$j++
										@endphp
									@else
										- {{ $data }}
									@endif
								@endif
							@endforeach
						</td>
						<td>{{ d_obj($detail, 'usage', ['title_en', 'title_kh']) }}</td>
						<td>{{ d_text($detail->other) }}</td>
					</tr>
				@endforeach
			</table>
			<small><b>Qty:</b> Quantity , <b>U/D:</b> Usage per Day , <b>NoD:</b> Number of Day</small>
		</section>
		
		<div class="bring-this-back">(សូមយកវេជ្ជបញ្ជានេះមកជាមួយ ពេលពិនិត្យលើកក្រោយ)</div>
		<x-para-clinic.print-footer />
	</section>

</x-print-layout>