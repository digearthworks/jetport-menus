
            <form action="{{url('/preferences')}}" method="post">
                @csrf @method('PATCH')

                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="navbar">Navbar theme</label>
                        <select id="navbar" name="navbar" class="form-control-sm col-12">
                            @if(Auth::user()->settings['navbar']=='bg-dark text-light')
                            <option class="bg-dark text-light" value="bg-dark text-light" selected>Dark</option>
                            @elseif(Auth::user()->settings['navbar']=='bg-secondary')
                            <option class="bg-secondary" value="bg-secondary" selected>Gray</option>
                            @elseif(Auth::user()->settings['navbar']=='bg-light')
                            <option value="bg-light">Light</option>
                            @elseif(Auth::user()->settings['navbar']=='bg-primary')
                            <option class="bg-primary" value="bg-primary">Blue</option>
                            @elseif(Auth::user()->settings['navbar']=='bg-info')
                            <option class="bg-info" value="bg-info">Teal</option>
                            @elseif(Auth::user()->settings['navbar']=='bg-danger')
                            <option class="bg-danger" value="bg-danger">Red</option>
                            @elseif(Auth::user()->settings['navbar']=='bg-warning')
                            <option class="bg-warning" value="bg-warning">Yellow</option>
                            @elseif(Auth::user()->settings['navbar']=='bg-success')
                            <option class="bg-success" value="bg-success">Green</option>
                            @else
                            <option selected></option>
                            @endif
                            <option value="">Default</option>
                            <option class="bg-dark text-light" value="bg-dark text-light">Dark</option>
                            <option class="bg-secondary" value="bg-secondary">Gray</option>
                            <option value="bg-light">Light</option>
                            <option class="bg-primary" value="bg-primary">Blue</option>
                            <option class="bg-info" value="bg-info">Teal</option>
                            <option class="bg-danger" value="bg-danger">Red</option>
                            <option class="bg-warning" value="bg-warning">Yellow</option>
                            <option class="bg-success" value="bg-success">Green</option>
                        </select>
                    </div>
                </div>
                @can('edit accounts')
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="sidbar">Sidebar theme</label>
                        <select id="sidebar" name="sidebar" class="form-control-sm col-12">
                            @if(Auth::user()->settings['sidebar'] =='bg-dark text-light')
                            <option class="bg-dark text-light" value="bg-dark text-light" selected>Dark</option>
                            @elseif(Auth::user()->settings['sidebar'] =='bg-secondary')
                            <option class="bg-secondary" value="bg-secondary" selected>Gray</option>
                            @elseif(Auth::user()->settings['sidebar'] =='bg-light')
                            <option value="bg-light">Light</option>
                            @elseif(Auth::user()->settings['sidebar'] =='bg-info')
                            <option class="bg-info" value="bg-info">Teal</option>
                            @elseif(Auth::user()->settings['sidebar'] =='bg-primary')
                            <option class="bg-primary" value="bg-primary">Blue</option>
                            @elseif(Auth::user()->settings['sidebar'] =='bg-danger')
                            <option class="bg-danger" value="bg-danger">Red</option>
                            @elseif(Auth::user()->settings['sidebar'] =='bg-warning')
                            <option class="bg-warning" value="bg-warning">Yellow</option>
                            @elseif(Auth::user()->settings['sidebar'] =='bg-success')
                            <option class="bg-success" value="bg-success">Green</option>
                            @else
                            <option selected></option>
                            @endif
                            <option value="">Default</option>
                            <option class="bg-dark text-light" value="bg-dark text-light">Dark</option>
                            <option class="bg-secondary" value="bg-secondary">Gray</option>
                            <option value="bg-light">Light</option>
                            <option class="bg-primary" value="bg-primary">Blue</option>
                            <option class="bg-info" value="bg-info">Teal</option>
                            <option class="bg-danger" value="bg-danger">Red</option>
                            <option class="bg-warning" value="bg-warning">Yellow</option>
                            <option class="bg-success" value="bg-success">Green</option>
                        </select>
                    </div>
                </div>
                @endcan
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="hotlink">Hotlink tabs</label>
                        <select id="hotlink" name="hotlink" class="form-control-sm col-12">
                            @if(Auth::user()->settings['hotlink'] =='bg-dark')
                            <option class="bg-dark text-light" value="bg-dark" selected>Dark</option>
                            @elseif(Auth::user()->settings['hotlink'] =='bg-secondary')
                            <option class="bg-secondary" value="bg-secondary" selected>Gray</option>
                            @elseif(Auth::user()->settings['hotlink'] =='bg-light')
                            <option value="bg-light">Light</option>
                            @elseif(Auth::user()->settings['hotlink'] =='bg-info')
                            <option class="bg-info" value="bg-info">Teal</option>
                            @elseif(Auth::user()->settings['hotlink'] =='bg-primary')
                            <option class="bg-primary" value="bg-primary">Blue</option>
                            @elseif(Auth::user()->settings['hotlink'] =='alert-danger')
                            <option class="alert-danger" value="alert-danger">Red</option>
                            @elseif(Auth::user()->settings['hotlink'] =='bg-warning')
                            <option class="bg-warning" value="bg-warning">Yellow</option>
                            @elseif(Auth::user()->settings['hotlink'] =='bg-success')
                            <option class="bg-success" value="bg-success">Green</option>
                            @else
                            <option selected></option>
                            @endif
                            <option value="">Default</option>
                            <option class="bg-dark text-light" value="bg-dark">Dark</option>
                            <option class="bg-secondary" value="bg-secondary">Gray</option>
                            <option value="bg-light">Light</option>
                            <option class="bg-primary" value="bg-primary">Blue</option>
                            <option class="bg-info" value="bg-info">Teal</option>
                            <option class="bg-danger" value="alert-danger">Red</option>
                            <option class="bg-warning" value="bg-warning">Yellow</option>
                            <option class="bg-success" value="bg-success">Green</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="icons">Text and Icons</label>
                        <select id="icons" name="icons" class="form-control-sm col-12">
                            @if(Auth::user()->settings['icons']=='text-dark')
                            <option class="text-dark" value="text-dark" selected><i class="far fa-image"></i>Dark
                            </option>
                            @elseif(Auth::user()->settings['icons']=='text-light')
                            <option class="text-light" value="text-light"><i class="far fa-image"></i>Light</option>
                            @elseif(Auth::user()->settings['icons']=='text-info')
                            <option class="text-primary" value="text-primary"><i class="far fa-image"></i>Blue</option>
                            @elseif(Auth::user()->settings['icons']=='text-danger')
                            <option class="text-danger" value="text-danger"><i class="far fa-image"></i>Red</option>
                            @elseif(Auth::user()->settings['icons']=='text-warning')
                            <option class="text-warning" value="text-warning"><i class="far fa-image"></i>Yellow
                            </option>
                            @elseif(Auth::user()->settings['icons']=='text-success')
                            <option class="text-success" value="text-success"><i class="far fa-image"></i>Green
                            </option>
                            @else
                            <option selected></option>
                            @endif
                            <option class="default-text" value="">Default</option>
                            <option class="text-dark" value="text-dark"><i class="far fa-image"></i>Dark</option>
                            <option class="text-light" value="text-light">Light</option>
                            <option class="text-primary" value="text-primary"><i class="far fa-image"></i>Blue</option>
                            <option class="text-danger" value="text-danger"><i class="far fa-image"></i>Red</option>
                            <option class="text-warning" value="text-warning"><i class="far fa-image"></i>Yellow
                            </option>
                            <option class="text-success" value="text-success"><i class="far fa-image"></i>Green
                            </option>
                        </select>
                    </div>
                </div>
                <div class="form-row">

                    <div class="form-group col-12">
                        <label for="background_img">Background image</label>
                        <input type="text" id="background_img" name="background_img"
                            value="{{Auth::user()->settings['background_img'] ?? (Auth::user()->background_img??'')}}"
                            class="form-control-sm col-12">
                    </div>
                </div>
                <button type="submit" class="btn alert-secondary shadow-sm">Submit</button>
                {{-- <a href="#" onclick="window.history.go(-1);" class="btn ml-auto btn-white shadow-sm">Cancel</a> --}}

            </form>

    <div id="popup" class="collapse alert-info shadow-sm rounded p-4 w-50 h-25" style="overflow-y:auto">

        @foreach($files as $file)
        @include('frontend.includes.partials.figure_img', ['src' => 'storage/stock-images/'.$file,
        'onclick' => "document.getElementById('background_img').value ='storage/stock-images/${file}';
        document.getElementById('popup').classList.remove('show');"
        ])
        @endforeach

    </div>

@push('document_ready')
var popup=$("#popup"); var ref=$("#background_img"); ref.on('focus',function(){ popup.toggleClass('show');
var popper=new Popper(ref,popup,{ placement:'bottom' }); });
@endpush
