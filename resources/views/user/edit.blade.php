@extends('layouts.user.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                {{method_field('PATCH')}}
                <div class="card text-center py-5">

                    <div class="row justify-content-center text-center">
                        <div>
                            <div>
                                <div class="form-group mx-auto my-5">
                                    <label for="exampleFormControlFile1"></label>
                                    <input type="file" class="form-control-file" id="image" name="image" value="画像を変更する">
                                </div>
                                <img src="../../images/profile.jpeg">
                            </div>
                            <div>
                                <div class="col-md-8">
                                    <input type="text" name="name" value="{{ $user->name }}">
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="phone_number" value="{{ $user->phone_number }}">
                                </div>
                            </div>
                        </div>
                        {{-- セレクトボックス後で実装 --}}
                        {{-- <div class="col-md-8">
                            <label for="">位置情報</label>
                            <div>
                                <select name="country" id="">
                                    <option value="Afghanistan">Afghanistan</option>
                                    <option value="Aland-Islands">Aland Islands</option>
                                    <option value="Albania">Albania</option>
                                    <option value="Algeria">Algeria</option>
                                    <option value="American-Samoa">American Samoa</option>
                                    <option value="Andorra">Andorra</option>
                                    <option value="Angola">Angola</option>
                                    <option value="Anguilla">Anguilla</option>
                                    <option value="Antarctica">Antarctica</option>
                                    <option value="Antigua-and-Barbuda">Antigua and Barbuda</option>
                                    <option value="Argentina">Argentina</option>
                                    <option value="Armenia">Armenia</option>
                                    <option value="Aruba">Aruba</option>
                                    <option value="Australia">Australia</option>
                                    <option value="Austria">Austria</option>
                                    <option value="Azerbaijan">Azerbaijan</option>
                                    <option value="Bahamas, The">Bahamas, The</option>
                                    <option value="Bahrain">Bahrain</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="Barbados">Barbados</option>
                                    <option value="Belarus">Belarus</option>
                                    <option value="Belgium">Belgium</option>
                                    <option value="Belize">Belize</option>
                                    <option value="Benin">Benin</option>
                                    <option value="Bermuda">Bermuda</option>
                                    <option value="Bhutan">Bhutan</option>
                                    <option value="Bolivia">Bolivia</option>
                                    <option value="Bosnia-and-Herzegovina">Bosnia and Herzegovina</option>
                                    <option value="Botswana">Botswana</option>
                                    <option value="Bouvet-Island">Bouvet Island</option>
                                    <option value="Brazil">Brazil</option>
                                    <option value="British-Indian-Ocean-Territory">British Indian Ocean Territory</option>
                                    <option value="British-Virgin-Islands">British Virgin Islands</option>
                                    <option value="Brunei">Brunei</option>
                                    <option value="Bulgaria">Bulgaria</option>
                                    <option value="Burkina-Faso">Burkina Faso</option>
                                    <option value="Burundi">Burundi</option>
                                    <option value="Cambodia">Cambodia</option>
                                    <option value="Cameroon">Cameroon</option>
                                    <option value="Canada">Canada</option>
                                    <option value="Cape-Verde">Cape Verde</option>
                                    <option value="Cayman-Islands">Cayman Islands</option>
                                    <option value="Central-African-Republic">Central African Republic</option>
                                    <option value="Chad">Chad</option>
                                    <option value="Chile">Chile</option>
                                    <option value="China, People's Republic of">China, People's Republic of</option>
                                    <option value="Christmas-Island">Christmas Island</option>
                                    <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                    <option value="Colombia">Colombia</option>
                                    <option value="Comoros">Comoros</option>
                                    <option value="Congo, Democratic Republic of the (Congo - Kinshasa)">Congo, Democratic Republic of the (Congo - Kinshasa)</option>
                                    <option value="japan">Japan</option>
                                </select>
                            </div>
                        </div> --}}
                        {{-- <div class="col-md-8">
                            <label for="">言語</label>
                            <div>
                                <select name="language" id="">
                                    <option value="english">English</option>
                                    <option value="japanese">Japanese(Japan)</option>
                                </select>
                            </div>
                        </div> --}}
                        <div class="col-md-8">
                            <label for="">メールアドレス</label>
                            <div>
                                <div class="col-md-8">
                                    <input type="text" name="email" value="{{ $user->email }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <button type="submit" class="btn btn-primary">変更を保存する</button>
                </div>
                {{-- <div class="col-md-2">
                    <a href="{{ route('user.logout') }}">
                        <div class="card">ログアウト</div>
                    </a>
                </div> --}}
            </form>
        </div>
    </div>
</div>
@endsection
