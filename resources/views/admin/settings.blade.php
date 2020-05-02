@extends('layouts.admin')
@section('title') Settings @endsection
@section('styles')
<link href="{{ asset('assets/vendors/jquery-minicolors/jquery.minicolors.css')}}" rel="stylesheet"/>
@endsection
@section('contents')
<div class="page-content fade-in-up">
	<div class="row">
		<div class="col-lg-12">
		    @include('admin.includes.error')
		    <div class="ibox">
            	<form action="{{ route('settings.update') }}" method="post" enctype="multipart/form-data">
            		@csrf
			        <div class="ibox-head">
			            <div class="ibox-title">Settings</div>
			            <ul class="nav nav-tabs tabs-line">
			                <li class="nav-item">
			                    <a class="nav-link active" href="#general" data-toggle="tab" aria-expanded="true">General</a>
			                </li>
			                <li class="nav-item">
			                    <a class="nav-link" href="#styles" data-toggle="tab" aria-expanded="false">Styles</a>
			                </li>
			                <li class="nav-item">
			                    <a class="nav-link" href="#mail" data-toggle="tab" aria-expanded="false">Mail</a>
			                </li>
			                <li class="nav-item">
			                    <a class="nav-link" href="#code" data-toggle="tab" aria-expanded="false">Code</a>
			                </li>
			                <li class="nav-item">
			                    <a class="nav-link" href="#server" data-toggle="tab" aria-expanded="false">Server</a>
			                </li>
			            </ul>
			            <button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-save"></i> Save </button>
			        </div>
			        <div class="ibox-body">
			            <div class="tab-content">
			                <div class="tab-pane fade active show" id="general" aria-expanded="true">
			                    <div class="form-group mb-4 row">
		                            <label class="col-sm-2 col-form-label">Site Name</label>
		                            <div class="col-sm-10">
		                                <input class="form-control form-control-solid" type="text" name="site_name" placeholder="Website Name" value="{{ $settings->site_name }}" >
		                            </div>
		                        </div>
		                        <div class="form-group mb-4 row">
		                            <label class="col-sm-2 col-form-label">Site Url</label>
		                            <div class="col-sm-10">
		                                <input class="form-control form-control-solid" type="text" name="site_url" placeholder="Website Url" value="{{ $settings->site_url }}">
		                            </div>
		                        </div>
		                        <div class="form-group mb-4 row">
		                            <label class="col-sm-2 col-form-label">Meta Title</label>
		                            <div class="col-sm-10">
		                                <textarea class="form-control form-control-solid" name="meta_title" rows="2" placeholder="Meta Title">{{ $settings->meta_title }}</textarea>
		                            </div>
		                        </div>
		                        <div class="form-group mb-4 row">
		                            <label class="col-sm-2 col-form-label">Meta Description</label>
		                            <div class="col-sm-10">
		                                <textarea class="form-control form-control-solid" name="meta_description" rows="4" placeholder="Meta Description">{{ $settings->meta_description }}</textarea>
		                            </div>
		                        </div>
		                        <div class="form-group mb-4 row">
		                            <label class="col-sm-2 col-form-label">Copyright</label>
		                            <div class="col-sm-10">
		                                <input class="form-control form-control-solid" type="text" name="copyright" placeholder="Copyright"  value="{{ $settings->copyright }}">
		                            </div>
		                        </div>
		                        <div class="form-group mb-4 row">
		                            <label class="col-sm-2 col-form-label">Support Mail</label>
		                            <div class="col-sm-10">
		                                <input class="form-control form-control-solid" type="text" name="email" placeholder="Support Mail"  value="{{ $settings->email }}">
		                            </div>
		                        </div>
			                </div>
			                <div class="tab-pane fade" id="styles" aria-expanded="false">
			                	<div class="form-group mb-4 row">
		                            <label class="col-sm-2 col-form-label">Upload Logo</label>
		                            <div class="col-sm-10">
		                                @if(file_exists($settings->logo))
		                                <img class="mr-3" src="{{ url($settings->logo) }}" alt="image" width="130">
		                                @else
		                                <img class="mr-3" src="{{ asset('assets/img/no-image.png')}}" alt="image" width="130">
		                                @endif
		                                <label class="btn btn-primary file-input mr-2">
	                                        <span class="btn-icon"><i class="la la-cloud-upload"></i>Browse file</span>
	                                        <input type="file" name="logo">
	                                    </label>
		                            </div>
		                        </div>
		                        <div class="form-group mb-4 row">
		                            <label class="col-sm-2 col-form-label">Upload Favicon</label>
		                            <div class="col-sm-10">
		                            	@if(file_exists($settings->favicon))
		                                <img class="mr-3" src="{{ url($settings->favicon) }}" alt="image" width="130">
		                                @else
		                                <img class="mr-3" src="{{ asset('assets/img/no-image.png')}}" alt="image" width="130">
		                                @endif
		                                <label class="btn btn-primary file-input mr-2">
	                                        <span class="btn-icon"><i class="la la-cloud-upload"></i>Browse file</span>
	                                        <input type="file" name="favicon">
	                                    </label>
		                            </div>
		                        </div>
		                        <div class="form-group mb-4 row">
		                            <label class="col-sm-2 col-form-label">Upload Cover</label>
		                            <div class="col-sm-10">
		                                @if(file_exists($settings->cover))
		                                <img class="mr-3" src="{{ url($settings->cover) }}" alt="image" width="130">
		                                @else
		                                <img class="mr-3" src="{{ asset('assets/img/no-image.png')}}" alt="image" width="130">
		                                @endif
		                                <label class="btn btn-primary file-input mr-2">
	                                        <span class="btn-icon"><i class="la la-cloud-upload"></i>Browse file</span>
	                                        <input type="file" name="cover">
	                                    </label>
		                            </div>
		                        </div>
		                        <div class="form-group mb-4 row">
		                            <label class="col-sm-2 col-form-label">Logo Width</label>
		                            <div class="col-sm-4">
		                                <input class="form-control form-control-solid" type="text" name="logo_width" placeholder="Logo Height"  value="{{ $settings->logo_width }}">
		                            </div>
		                        </div>
		                        <div class="form-group mb-4 row">
		                            <label class="col-sm-2 col-form-label">Logo Height</label>
		                            <div class="col-sm-4">
		                                <input class="form-control form-control-solid" type="text" name="logo_height" placeholder="Logo Height"  value="{{ $settings->logo_height }}">
		                            </div>
		                        </div>
		                        <div class="form-group mb-4 row">
		                            <label class="col-sm-2 col-form-label">Main Color</label>
		                            <div class="col-sm-4">
		                                <input class="form-control form-control-solid minicolors" type="text" name="main_color" placeholder="Main Color"  value="{{ $settings->main_color }}" autocomplete="off">
		                            </div>
		                        </div>
		                         <div class="form-group mb-4 row">
		                            <label class="col-sm-2 col-form-label">Body Color</label>
		                            <div class="col-sm-4">
		                                <input class="form-control form-control-solid minicolors" type="text" name="body_color" placeholder="Body Color"  value="{{ $settings->body_color }}" autocomplete="off">
		                            </div>
		                        </div>
		                        <div class="form-group mb-4 row">
		                            <label class="col-sm-2 col-form-label">Header Color</label>
		                            <div class="col-sm-4">
		                                <input class="form-control form-control-solid minicolors" type="text" name="header_color" placeholder="Header Color"  value="{{ $settings->header_color }}"autocomplete="off">
		                            </div>
		                        </div>
		                        <div class="form-group mb-4 row">
		                            <label class="col-sm-2 col-form-label">Footer Color</label>
		                            <div class="col-sm-4">
		                                <input class="form-control form-control-solid minicolors" type="text" name="footer_color" placeholder="Footer Color" value="{{ $settings->footer_color }}" autocomplete="off">
		                            </div>
		                        </div>
			                </div>
			                <div class="tab-pane fade" id="mail" aria-expanded="false">
			                    <div class="form-group mb-4 row">
		                            <label class="col-sm-2 col-form-label">Mail Driver</label>
		                            <div class="col-sm-7">
		                                <input class="form-control form-control-solid" type="text" name="mail_driver" placeholder="Mail Driver" value="{{ $settings->mail_driver }}">
		                            </div>
		                        </div>
		                        <div class="form-group mb-4 row">
		                            <label class="col-sm-2 col-form-label">Mail Host</label>
		                            <div class="col-sm-7">
		                                <input class="form-control form-control-solid" type="text" name="mail_host" placeholder="Mail Host" value="{{ $settings->mail_host }}">
		                            </div>
		                        </div>
		                        <div class="form-group mb-4 row">
		                            <label class="col-sm-2 col-form-label">Mail Username</label>
		                            <div class="col-sm-7">
		                                <input class="form-control form-control-solid" type="text" name="mail_username" placeholder="Mail Username" value="{{ $settings->mail_username }}">
		                            </div>
		                        </div>
		                        <div class="form-group mb-4 row">
		                            <label class="col-sm-2 col-form-label">Mail Password</label>
		                            <div class="col-sm-7">
		                                <input class="form-control form-control-solid" type="text" name="mail_password" placeholder="Mail Password" value="{{ $settings->mail_password }}">
		                            </div>
		                        </div>
		                        <div class="form-group mb-4 row">
		                            <label class="col-sm-2 col-form-label">Mail Port</label>
		                            <div class="col-sm-7">
		                                <input class="form-control form-control-solid" type="text" name="mail_port" placeholder="Mail Port" value="{{ $settings->mail_port }}">
		                            </div>
		                        </div>
		                        <div class="form-group mb-4 row">
		                            <label class="col-sm-2 col-form-label">Mail From</label>
		                            <div class="col-sm-7">
		                                <input class="form-control form-control-solid" type="text" name="mail_from" placeholder="Mail From" value="{{ $settings->mail_from }}">
		                            </div>
		                        </div>
		                        <div class="form-group mb-4 row">
		                            <label class="col-sm-2 col-form-label">Mail Encryption</label>
		                            <div class="col-sm-7">
		                                <input class="form-control form-control-solid" type="text" name="mail_encryption" placeholder="Mail Encryption" value="{{ $settings->mail_encryption }}">
		                            </div>
		                        </div>
			                </div>
			                <div class="tab-pane fade" id="code" aria-expanded="false">
			                	<div class="form-group mb-4 row">
		                            <label class="col-sm-2 col-form-label">Header Code</label>
		                            <div class="col-sm-10">
		                                <textarea class="form-control form-control-solid" name="header_code" rows="9" placeholder="Header Code">{{ $settings->header_code }}</textarea>
		                            </div>
		                        </div>
		                        <div class="form-group mb-4 row">
		                            <label class="col-sm-2 col-form-label">Footer Code</label>
		                            <div class="col-sm-10">
		                                <textarea class="form-control form-control-solid" name="footer_code" rows="9" placeholder="Footer Code">{{ $settings->footer_code }}</textarea>
		                            </div>
		                        </div>
			                </div>
			                <div class="tab-pane fade" id="server" aria-expanded="false">
			                	<div class="form-group row">
	                                <div class="col-3">Maintenance Mode</div>
	                                <div class="col-3">
	                                    <label class="ui-switch">
	                                        <input type="checkbox" name="maintenance" value="1" {{ $settings->maintenance==1 ? 'checked': ''}}>
	                                        <span></span>
	                                    </label>
	                                </div>
	                            </div>
	                            <div class="form-group row">
	                                <div class="col-3">SSL Certificate</div>
	                                <div class="col-3">
	                                    <label class="ui-switch">
	                                        <input type="checkbox" name="ssl" value="1" {{ $settings->ssl==1 ? 'checked': '' }}>
	                                        <span></span>
	                                    </label>
	                                </div>
	                            </div>
	                            <div class="form-group row">
	                                <div class="col-3">App Debug</div>
	                                <div class="col-3">
	                                    <label class="ui-switch">
	                                        <input type="checkbox" name="app_debug" value="1" {{ $settings->app_debug==1 ? 'checked' :'' }}>
	                                        <span></span>
	                                    </label>
	                                </div>
	                            </div>
	                            <div class="form-group mb-4 row">
		                            <label class="col-sm-2 col-form-label">Timezone</label>
		                            <div class="col-sm-4">
		                                <input class="form-control form-control-solid" type="text" name="timezone" placeholder="Timezone" value="{{ $settings->timezone }}">
		                            </div>
		                        </div>
	                            <div class="form-group mb-4 row">
		                            <label class="col-sm-2 col-form-label">Max Upload Size<small> (MB)</small></label>
		                            <div class="col-sm-4">
		                                <input class="form-control form-control-solid" type="text" name="max_upload_size" placeholder="Max Upload Size" value="{{ $settings->max_upload_size }}">
		                            </div>
		                        </div>
			                </div>
			            </div>
			        </div>
		    	</form>
		    </div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('assets/vendors/jquery-minicolors/jquery.minicolors.min.js')}}"></script>
<script type="text/javascript">
	 $(document).ready( function() {

      $('.minicolors').each( function() {
        $(this).minicolors({
          control: $(this).attr('data-control') || 'hue',
          defaultValue: $(this).attr('data-defaultValue') || '',
          format: $(this).attr('data-format') || 'hex',
          keywords: $(this).attr('data-keywords') || '',
          inline: $(this).attr('data-inline') === 'true',
          letterCase: $(this).attr('data-letterCase') || 'lowercase',
          opacity: $(this).attr('data-opacity'),
          position: $(this).attr('data-position') || 'bottom',
          swatches: $(this).attr('data-swatches') ? $(this).attr('data-swatches').split('|') : [],
          change: function(value, opacity) {
            if( !value ) return;
            if( opacity ) value += ', ' + opacity;
            if( typeof console === 'object' ) {
              console.log(value);
            }
          },
          theme: 'bootstrap'
        });

      });
    });
</script>
@endsection