@extends('admin::layouts.content')

@section('page_title')
{{ __('admin::app.configuration.title') }}
@stop



@section('content')
<div class="content">

    <form method="POST" action="{{ route('admin.themesettings.store') }}" @submit.prevent="onSubmit" enctype="multipart/form-data">

        <div class="page-header">

            <div class="page-title">
                <h1>
                    {{ __('admin::app.configuration.title') }}
                </h1>
            </div>

            <div class="page-action">
                <button type="submit" class="btn btn-lg btn-primary">
                    {{ __('admin::app.configuration.save-btn-title') }}
                </button>
            </div>
        </div>

        <div class="page-content">
            <div class="form-container">
                @csrf()

                <accordian title="Banner 1" :active="true">
                    <div slot="body">
                        <?php
                        $bannerContent = isset($banners[0]) ? $banners[0]->content : "";
                        $imagePath =
                            isset($banners[0]) ? $banners[0]->image_url : "";
                        ?>
                        <div class="control-group" :class="[errors.has('content1') ? 'has-error' : '']">
                            <label for="content1" class="required">Content</label>
                            <textarea id="banner1" class="control" name="content1" rows="5"><?php echo $bannerContent; ?></textarea>
                            <span class="control-error" v-if="errors.has('content1')">@{{ errors.first('content1') }}</span>
                        </div>

                        <div class="control-group {!! $errors->has('image.*') ? 'has-error' : '' !!}">
                            <label class="required">{{ __('admin::app.catalog.categories.image') }}</label>

                            <image-wrapper :button-label="'{{ __('admin::app.settings.sliders.image') }}'" input-name="image1" :multiple="false" :images='"{{ Storage::url($imagePath) }}"'></image-wrapper>

                            <span class="control-error" v-if="{!! $errors->has('image.*') !!}">
                                @foreach ($errors->get('image.*') as $key => $message)
                                @php echo str_replace($key, 'Image', $message[0]); @endphp
                                @endforeach
                            </span>
                        </div>

                        <div class="control-group" :class="[errors.has('link1') ? 'has-error' : '']">
                            <label for="link1">Href Url</label>
                            <input type="text" class="control" name="link1">
                            <span class="control-error" v-if="errors.has('link1')">@{{ errors.first('link1') }}</span>
                        </div>

                    </div>
                </accordian>

                <accordian title="Banner 2" :active="false">
                    <div slot="body">
                        <?php
                        $bannerContent = isset($banners[1]) ? $banners[1]->content : "";
                        $imagePath =
                            isset($banners[1]) ? $banners[1]->image_url : "";
                        ?>
                        <div class="control-group" :class="[errors.has('content2') ? 'has-error' : '']">
                            <label for="content2" class="required">Content</label>
                            <textarea id="banner2" class="control" name="content2" rows="5"><?php echo $bannerContent; ?></textarea>
                            <span class="control-error" v-if="errors.has('content2')">@{{ errors.first('content2') }}</span>
                        </div>

                        <div class="control-group {!! $errors->has('image.*') ? 'has-error' : '' !!}">
                            <label class="required">{{ __('admin::app.catalog.categories.image') }}</label>

                            <image-wrapper :button-label="'{{ __('admin::app.settings.sliders.image') }}'" input-name="image2" :multiple="false" :images='"{{ Storage::url($imagePath) }}"'></image-wrapper>

                            <span class="control-error" v-if="{!! $errors->has('image.*') !!}">
                                @foreach ($errors->get('image.*') as $key => $message)
                                @php echo str_replace($key, 'Image', $message[0]); @endphp
                                @endforeach
                            </span>
                        </div>

                        <div class="control-group" :class="[errors.has('link2') ? 'has-error' : '']">
                            <label for="link2">Href Url</label>
                            <input type="text" class="control" name="link2">
                            <span class="control-error" v-if="errors.has('link2')">@{{ errors.first('link2') }}</span>
                        </div>

                    </div>
                </accordian>

                <accordian title="Banner 3" :active="false">
                    <div slot="body">
                        <?php
                        $bannerContent = isset($banners[2]) ? $banners[2]->content : "";
                        $imagePath =
                            isset($banners[2]) ? $banners[2]->image_url : "";
                        ?>
                        <div class="control-group" :class="[errors.has('content3') ? 'has-error' : '']">
                            <label for="content3" class="required">Content</label>
                            <textarea id="banner3" class="control" name="content3" rows="5"><?php echo $bannerContent; ?></textarea>
                            <span class="control-error" v-if="errors.has('content3')">@{{ errors.first('content3') }}</span>
                        </div>

                        <div class="control-group {!! $errors->has('image.*') ? 'has-error' : '' !!}">
                            <label class="required">{{ __('admin::app.catalog.categories.image') }}</label>

                            <image-wrapper :button-label="'{{ __('admin::app.settings.sliders.image') }}'" input-name="image3" :multiple="false" :images='"{{ Storage::url($imagePath) }}"'></image-wrapper>

                            <span class="control-error" v-if="{!! $errors->has('image.*') !!}">
                                @foreach ($errors->get('image.*') as $key => $message)
                                @php echo str_replace($key, 'Image', $message[0]); @endphp
                                @endforeach
                            </span>
                        </div>

                        <div class="control-group" :class="[errors.has('link3') ? 'has-error' : '']">
                            <label for="link3">Href Url</label>
                            <input type="text" class="control" name="link3">
                            <span class="control-error" v-if="errors.has('link3')">@{{ errors.first('link3') }}</span>
                        </div>

                    </div>
                </accordian>

                <accordian title="Banner 4" :active="false">
                    <div slot="body">
                        <?php
                        $bannerContent = isset($banners[3]) ? $banners[3]->content : "";
                        $imagePath =
                            isset($banners[3]) ? $banners[3]->image_url : "";
                        ?>
                        <div class="control-group" :class="[errors.has('content4') ? 'has-error' : '']">
                            <label for="content4" class="required">Content</label>
                            <textarea id="banner4" class="control" name="content4" rows="5"><?php echo $bannerContent; ?></textarea>
                            <span class="control-error" v-if="errors.has('content4')">@{{ errors.first('content4') }}</span>
                        </div>

                        <div class="control-group {!! $errors->has('image.*') ? 'has-error' : '' !!}">
                            <label class="required">{{ __('admin::app.catalog.categories.image') }}</label>

                            <image-wrapper :button-label="'{{ __('admin::app.settings.sliders.image') }}'" input-name="image4" :multiple="false" :images='"{{ Storage::url($imagePath) }}"'></image-wrapper>

                            <span class="control-error" v-if="{!! $errors->has('image.*') !!}">
                                @foreach ($errors->get('image.*') as $key => $message)
                                @php echo str_replace($key, 'Image', $message[0]); @endphp
                                @endforeach
                            </span>
                        </div>

                        <div class="control-group" :class="[errors.has('link4') ? 'has-error' : '']">
                            <label for="link4">Href Url</label>
                            <input type="text" class="control" name="link4">
                            <span class="control-error" v-if="errors.has('link4')">@{{ errors.first('link4') }}</span>
                        </div>

                    </div>
                </accordian>


            </div>
        </div>

    </form>
</div>
@stop

@push('scripts')
@include('rastventure::admin.layouts.tinymce')

<script>
    $(document).ready(function() {
        tinyMCEHelper.initTinyMCE({
            selector: 'textarea#banner1,textarea#banner2, textarea#banner3, textarea#banner4',
            height: 200,
            width: "100%",
            plugins: 'image imagetools media wordcount save fullscreen code table lists link hr',
            toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor link hr | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat | code | table',
            image_advtab: true,
            templates: [{
                    title: 'Test template 1',
                    content: 'Test 1'
                },
                {
                    title: 'Test template 2',
                    content: 'Test 2'
                }
            ],
            csrfToken: '{{ csrf_token() }}',
        });
    });
</script>
@endpush