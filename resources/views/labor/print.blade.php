<x-print-layout>

	<section class="print-preview-a4">
		<header>
			<x-para-clinic.print-header :row="$labor" title="Laboratory Report">
				<tr>
					<td width="17%"><b>ស្នើដោយ/Prescripteur</b></td>
					<td>: {{ $labor->requested_by_name }}</td>
					<td width="10%"><b>គំរូ/Sample</b></td>
					<td colspan="3">: BLOOD</td>
				</tr>
			</x-para-clinic.print-header>
		</header>
		<section class="labor-body">
			<section class="type-section">
				@foreach ($labor_detail as $row_detail)
					@if ($row_detail['type'] == 'main_label')
						<h4 class="text-uppercase text-underline text-center mt-1">{{ $row_detail['data'] }}</h4>
					@elseif ($row_detail['type'] == 'label')
						<section class="category-section">
							<div class="text-uppercase mt-1">{{ $row_detail['data'] }}</div>
						</section>
					@elseif ($row_detail['type'] == 'result')
						<section class="category-section">
							<table width="100%" class="ml-1">
								@foreach ($row_detail['data'] as $test)
									@php
										$item = $test->item;
										// Check if Range is valid for compare
										$is_range_valid = str_contains($item->other, 'OUT_RANGE_COLOR_RED') && is_numeric($item->min_range) && is_numeric($item->max_range) && $item->min_range > 0 && $item->max_range > 0;
										// Check if it over / under range
										$is_over_range = $is_range_valid && ($test->value > $item->max_range);
										$is_under_range = $is_range_valid && ($test->value < $item->min_range);
										// Checke if Negative/Positive
										$is_negative_color = str_contains($item->other, 'VALUE_POSITIVE_NEGATIVE') && $test->value == 'POSITIVE'
									@endphp
									<tr>
										<td class="leaders">
											<div>
												<span>{{ $item->name_en }}</span>
												<span>:</span>
											</div>
										</td>
										<td width="14%">&nbsp;
											<strong style="color : {{ (($is_over_range || $is_negative_color) ? 'red' : (($is_under_range) ? 'green' : 'black')) }};">
												{{ $test->value }}
											</strong>
										</td>
										<td width="15%">{!! apply_markdown_character($item->unit) !!}</td>
										<td width="28%">
											@if (is_numeric($item->min_range) && is_numeric($item->max_range) && $item->max_range > 0 && $item->max_range > $item->min_range)
												({{ $item->min_range }} - {{ $item->max_range }})
											@endif
										</td>
									</tr>
								@endforeach
							</table>
						</section>
					@endif
				@endforeach
			</section>
		</section>
		<div class="signature">
			<div class="text-center">ថ្ងៃទី {{ date('d/m/Y', strtotime($labor->requested_at)) }}</div>
			<div class="text-center">Dr. <span class="KHMOULLIGHT">{{ $labor->doctor_kh }}</span></div>
			<img src="{{ asset('images/site/signature.png') }}" alt="">
		</div>

		<x-para-clinic.print-footer />
	</section>

</x-print-layout>