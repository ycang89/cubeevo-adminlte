@extends('app')
<?php
use App\Models\Status;
use App\Models\Locale;
use App\Models\Files;
use App\Models\Category;

$locales    = Locale::where('status', '=', STATUS::ACTIVE)->get();
$categories = Category::where('status', '=', STATUS::ACTIVE)->get();
$imgIds     = array();
$sortOrders = array();
foreach ($project->projectImages()->get() as $img)
{
	$imgIds[]     = $img->image->id;
	$sortOrders[] = $img->sort_order;
}
?>

@section('htmlheader_title')
Project Management
@endsection

@section('contentheader_title')
Project Management
@endsection

@section('contentheader_description')
Description for project management
@endsection

@section('main-content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Edit Project #{{ $project->id }}</h3>
			</div>
			<form method="POST" action="{{ url('manage/project/update/' . $project->id) }}" accept-charset="UTF-8" enctype="multipart/form-data">
				<input name="_token" type="hidden" value="{{{ csrf_token() }}}" />
				<input name="_method" type="hidden" value="PUT" />
				<div class="box-body">
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs">
						@if (isset($locales) && !$locales->isEmpty())
							<?php $count = 0; ?>
							@foreach ($locales as $locale)
								<?php $count++; ?>
								<li class="{{ ($count == 1) ? 'active' : '' }}"><a href="#{{ $locale->language }}" data-toggle="tab">{{ strtoupper($locale->language) }}</a></li>
							@endforeach
						@endif
						</ul>
						<div class="tab-content">
						@if (isset($locales) && !$locales->isEmpty())
							<?php $count = 0; ?>
							@foreach ($locales as $locale)
								<?php $count++; ?>
								<div id="{{ $locale->language }}" class="tab-pane {{ ($count == 1) ? 'active' : '' }}">
									<div class="form-group">
										<label for="name" class="control-label">Name</label>
										<input id="name" name="name[{{ $locale->id }}]" type="text" class="form-control" value="{{ $project->translate($locale->language)->name }}" />
									</div>
									<div class="form-group">
										<label for="background" class="control-label">Background</label>
										<textarea id="background" name="background[{{ $locale->id }}]" type="text" class="form-control" rows="4">{{ $project->translate($locale->language)->background }}</textarea>
									</div>
									<div class="form-group">
										<label for="challenge" class="control-label">Challenge</label>
										<textarea id="challenge" name="challenge[{{ $locale->id }}]" type="text" class="form-control" rows="4">{{ $project->translate($locale->language)->challenge }}</textarea>
									</div>
									<div class="form-group">
										<label for="result" class="control-label">Result</label>
										<textarea id="result" name="result[{{ $locale->id }}]" type="text" class="form-control" rows="4">{{ $project->translate($locale->language)->result }}</textarea>
									</div>
									<div class="form-group">
										<label for="founder" class="control-label">Founder</label>
										<input id="founder" name="founder[{{ $locale->id }}]" type="text" class="form-control" value="{{ $project->translate($locale->language)->founder }}" />
									</div>
									<div class="form-group">
										<label for="client_name" class="control-label">Client Name</label>
										<input id="client_name" name="client_name[{{ $locale->id }}]" type="text" class="form-control" value="{{ $project->translate($locale->language)->client_name }}" />
									</div>
								</div>
							@endforeach
						@endif
						</div>
					</div>
					<div class="form-group">
						<label for="category_id" class="control-label">Category</label>
						<select id="category_id" name="category_id" class="form-control">
							@foreach ($categories as $category)
							<option value="{{ $category->id }}" {{ (isset($project->category_id) && $project->category_id == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="year" class="control-label">Year</label>
						<input id="year" name="year" type="text" class="form-control" value="{{ $project->year }}" />
					</div>
					<!--
					<div class="form-group">
						<label for="img_ids" class="control-label">Banners</label>
						<input id="img_ids" name="img_ids" type="text" class="form-control" value="" />
					</div>
					-->
					<div class="row"> 
						<div class="form-group col-sm-4">
							<label for="pri_color_code" class="control-label">Primary Color</label>
							<div class="input-group colorpicker-element">
								<input id="pri_color_code" name ="pri_color_code" type="text" class="form-control" value="{{ $project->pri_color_code }}" />
								<div class="input-group-addon">
									<i style="background-color: {{ $project->pri_color_code }};"></i>
								</div>
							</div>
						</div>
						<div class="form-group col-sm-4">
							<label for="sec_color_code" class="control-label">Secondary Color</label>
							<div class="input-group colorpicker-element">
								<input id="sec_color_code" name ="sec_color_code" type="text" class="form-control" value="{{ $project->sec_color_code }}" />
								<div class="input-group-addon">
									<i style="background-color: {{ $project->sec_color_code }};"></i>
								</div>
							</div>
						</div>
						<div class="form-group col-sm-4">
							<label for="txt_color_code" class="control-label">Text Color</label>
							<div class="input-group colorpicker-element">
								<input id="txt_color_code" name ="txt_color_code" type="text" class="form-control" value="{{ $project->txt_color_code }}" />
								<div class="input-group-addon">
									<i style="background-color: {{ $project->txt_color_code }};"></i>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="sort_order" class="control-label">Sort Order</label>
						<input id="sort_order" name ="sort_order" type="text" class="form-control" value="{{ $project->sort_order }}" />
					</div>
					<legend><b>Images</b></legend>
					<div class="row">
						<div class="col-md-4">
							<div class="thumbnail">
								<img id="grid_img" class="img-thumbnail" src="{{ $project->frontImage->dir }}" alt="{{ $project->frontImage->name }}">
								<div class="caption" style="text-align: center;">
									<p><strong>Grid Front Image</strong></p>
									<div class="row">
										<div class="col-xs-6">
											<a href="#" class="btn btn-block btn-primary" role="button" data-toggle="modal" data-target="#modal-grid-img"><i class="fa fa-cloud-upload"></i> Upload New</a> 
										</div>
										<div class="col-xs-6">
											<a href="#" class="btn btn-block btn-default" role="button" data-toggle="modal" data-target="#modal-upload" onclick="useExist('grid_img_id')"><i class="fa fa-image"></i> Use Existing</a>
										</div> 
									</div>
								</div>
							</div>
						</div>
						<input type="hidden" id="grid_img_id" name="grid_img_id" value="{{ $project->grid_img_id }}" />
						<div class="col-md-4">
							<div class="thumbnail">
								<img id="grid_bg_img" class="img-thumbnail" src="{{ $project->backgroundImage->dir }}" alt="{{ $project->backgroundImage->name }}">
								<div class="caption" style="text-align: center;">
									<p><strong>Grid Background Image</strong></p>
									<div class="row">
										<div class="col-xs-6">
											<a href="#" class="btn btn-block btn-primary" role="button" data-toggle="modal" data-target="#modal-grid-bg-img"><i class="fa fa-cloud-upload"></i> Upload New</a> 
										</div>
										<div class="col-xs-6">
											<a href="#" class="btn btn-block btn-default" role="button" data-toggle="modal" data-target="#modal-upload" onclick="useExist('grid_bg_img_id')"><i class="fa fa-image"></i> Use Existing</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<input type="hidden" id="grid_bg_img_id" name="grid_bg_img_id" value="{{ $project->grid_bg_img_id }}" />
						<div class="col-md-4">
							<div class="thumbnail">
								<img id="brand_img" class="img-thumbnail" src="{{ $project->brandImage->dir }}" alt="{{ $project->brandImage->name }}">
								<div class="caption" style="text-align: center;">
									<p><strong>Brand Image</strong></p>
									<div class="row">
										<div class="col-xs-6">
											<a href="#" class="btn btn-block btn-primary" role="button" data-toggle="modal" data-target="#modal-brand-img"><i class="fa fa-cloud-upload"></i> Upload New</a> 
										</div>
										<div class="col-xs-6">
											<a href="#" class="btn btn-block btn-default" role="button" data-toggle="modal" data-target="#modal-upload" onclick="useExist('brand_img_id')"><i class="fa fa-image"></i> Use Existing</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<input type="hidden" id="brand_img_id" name="brand_img_id" value="{{ $project->brand_img_id }}" />
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="thumbnail">
								<div class="caption" style="text-align: center;">
									<p><strong>Project Images</strong></p>
									<div class="row">
										<div class="col-xs-6">
											<a href="#" class="btn btn-block btn-primary" role="button" data-toggle="modal" data-target="#modal-new-project-img"><i class="fa fa-cloud-upload"></i> Upload New</a> 
										</div>
										<div class="col-xs-6">
											<a href="#" class="btn btn-block btn-default" role="button" data-toggle="modal" data-target="#modal-project-img" onclick="useExist('project_img_id')"><i class="fa fa-image"></i> Use Existing</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<input type="hidden" id="project_img_ids" name="project_img_ids" value="{{ implode(",", $imgIds) }}" />
						<input type="hidden" id="project_img_sort_order" name="project_img_sort_order" value="{{ implode(",", $sortOrders) }}" />
					</div>
				</div>
				<input type="hidden" id="selected_img" value="" />
				<div class="box-footer clearfix">
					<div class="pull-right">
						<a href="{{ url('/admin/manage/project/') }}" class="btn btn-default">Cancel</a>
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</div>
				<!-- Grid Image - Modal -->
				<div class="modal fade" id="modal-grid-img" tabindex="-1" role="dialog" aria-labelledby="modal-grid-img">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="modal">Upload new grid front image</h4>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<label for="new_grid_img_id" class="control-label">New Grid Front Image</label>
									<input type="file" class="form-control" id="new_grid_img_id" name="new_grid_img_id" />
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
							</div>
						</div>
					</div>
				</div>
				<!-- Grid Background Image - Modal -->
				<div class="modal fade" id="modal-grid-bg-img" tabindex="-1" role="dialog" aria-labelledby="modal-grid-bg-img">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="modal">Upload new grid background image</h4>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<label for="new_grid_bg_img_id" class="control-label">New Grid Background Image</label>
									<input type="file" class="form-control" id="new_grid_bg_img_id" name="new_grid_bg_img_id" />
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
							</div>
						</div>
					</div>
				</div>
				<!-- Brand Image - Modal -->
				<div class="modal fade" id="modal-brand-img" tabindex="-1" role="dialog" aria-labelledby="modal-brand-img">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="modal">Upload new brand image</h4>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<label for="new_brand_img_id" class="control-label">New Brand Image</label>
									<input type="file" class="form-control" id="new_brand_img_id" name="new_brand_img_id" />
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
							</div>
						</div>
					</div>
				</div>
				<!-- New Project Image - Modal -->
				<div class="modal fade" id="modal-new-project-img" tabindex="-1" role="dialog" aria-labelledby="modal-new-project-img">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="modal">Upload new project images</h4>
							</div>
							<div class="modal-body">
								<div class="form-group" id="new_project_img_container">
									<label for="new_project_img_id" class="control-label">New Project Image</label>
									<input type="file" class="form-control new_project_img" id="new_project_img_id" name="new_project_img_id[]" />
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" onclick="addProjectImg()">Add More</button>
								<button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-upload" tabindex="-1" role="dialog" aria-labelledby="modal-upload">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="modal">Choose from existing image collection</h4>
			</div>
			<div class="modal-body" style="max-height: 450px; overflow-y: auto;">
				<?php $count = 0; ?>
				<?php $images = Files::where('status', '=', STATUS::ACTIVE)->get(); ?>
				@foreach ($images as $image)
				<?php $count++; ?>
				@if ($count % 4 == 1)
				<div class="row">
				@endif
					<div class="col-xs-6 col-md-3">
						<button class="thumbnail" data-dismiss="modal" onclick="selectImg({{ $image->id }}, '{{ $image->dir }}')">
							<img src="{{ $image->dir }}" alt="{{ $image->name }}">
						</button>
					</div>
				@if (($count % 4 == 0) || ($count == $images->count())) 
				</div>
        		@endif
				@endforeach
			</div>
		</div>
	</div>
</div>

<!-- Project Image - Modal -->
<div class="modal fade" id="modal-project-img" tabindex="-1" role="dialog" aria-labelledby="modal-project-img">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="modal">Choose from existing image collection</h4>
			</div>
			<div class="modal-body" style="max-height: 450px; overflow-y: auto;">
				<?php $count = 0; ?>
				<?php $images = Files::where('status', '=', STATUS::ACTIVE)->get(); ?>
				@foreach ($images as $image)
				<?php $count++; ?>
				<?php $projImage = $project->projectImages()->where('img_id', $image->id)->first(); ?>
				@if ($count % 4 == 1)
				<div class="row">
				@endif
					<div class="col-xs-6 col-md-3">
						<div class="thumbnail" style="text-align: center;">
							<img src="{{ $image->dir }}" alt="{{ $image->name }}" class="img-thumbnail">
							<input type="checkbox" class="project_img" value="{{ $image->id }}" onclick="selectProjectImg()" {{ (isset($projImage)) ? 'checked' : '' }} />
							<span><b>Use</b></span>
							<div id="img_sort_order_container_{{ $image->id }}" style="display: {{ (isset($projImage)) ? '' : 'none' }};">
								<label for="img_sort_order">Sort Order</label>
								<input type="text" class="form-control img_sort_order" id="img_sort_order" value="{{ (isset($projImage)) ? $projImage->sort_order : '' }}" />
							</div>
						</div>
					</div>
				@if (($count % 4 == 0) || ($count == $images->count())) 
				</div>
        		@endif
				@endforeach
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
			</div>
		</div>
	</div>
</div>
@endsection

@section('addon-script')
<script type="text/javascript">
$(document).ready(function()
{
	$('.colorpicker-element').colorpicker();

	$('.img_sort_order').on('keyup', function()
	{
		setImgSortOrder();
	});
});

function useExist(imgType)
{
	$('#selected_img').val(imgType);
}

function selectImg(imgId, imgSrc)
{
	var imgType = $('#selected_img').val();

	if (imgType != '')
	{
		$('#' + imgType).val(imgId);

		if (imgType == 'grid_img_id')
		{
			$('#grid_img').attr('src', imgSrc);
		}
		else if (imgType == 'grid_bg_img_id')
		{
			$('#grid_bg_img').attr('src', imgSrc);
		}
		else if (imgType == 'brand_img_id')
		{
			$('#brand_img').attr('src', imgSrc);
		}
	}
}

function selectProjectImg()
{
	var imgIds = [];

	$('.project_img').each(function()
	{
		var imgId = $(this).val();

		if ($(this).is(':checked'))
		{
			imgIds.push(imgId);
			$('#img_sort_order_container_' + imgId).show();
		}
		else
		{
			$('#img_sort_order_' + imgId).val('');
			$('#img_sort_order_container_' + imgId).hide();
		}
	});

	$('#project_img_ids').val(imgIds.join(','));
	setImgSortOrder();
}

function setImgSortOrder()
{
	var sortOrder = [];

	$('.img_sort_order').each(function()
	{
		if ($(this).closest('.thumbnail').find('.project_img').is(':checked'))
		{
			if ($(this).val() != '')
			{
				sortOrder.push($(this).val());
			}
			else
			{
				sortOrder.push(0);
			}
		}
	});

	$('#project_img_sort_order').val(sortOrder.join(','));
}

function addProjectImg()
{
	$('.new_project_img:last').clone().appendTo('#new_project_img_container');
}
</script>
@endsection