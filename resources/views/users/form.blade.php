<div class="form-group row">
  <label for="vardas" class="col-form-label">*Vardas</label>
  <input
    id="vardas"
    name="vardas"
    type="text"
    class="form-control @error('vardas') is-invalid @enderror"
    value="{{ old('vardas') ?? $user->vardas ?? '' }}"
    required
    minlength="2"
    maxlength="32"
    autocomplete="given-name"
    autofocus>

  @error('vardas')
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
  @enderror
</div>


<div class="form-group row">
  <label for="pavarde" class="col-form-label">*Pavardė</label>
  <input
    id="pavarde"
    name="pavarde"
    type="text"
    class="form-control @error('pavarde') is-invalid @enderror"
    value="{{ old('pavarde') ?? $user->pavarde ?? '' }}"
    required
    minlength="2"
    maxlength="32"
    autocomplete="family-name">

  @error('pavarde')
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
  @enderror
</div>


<div class="form-group row">
  <label for="email" class="col-form-label">*E-paštas <i class="fa fa-at"></i></label>
  <input
    id="email"
    name="email"
    type="email"
    class="form-control @error('email') is-invalid @enderror"
    value="{{ old('email') ?? $user->email ?? '' }}"
    required
    minlength="2"
    maxlength="32"
    autocomplete="email">

  @error('email')
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
  @enderror
</div>


<div class="form-group row">
  <label for="password" class="col-form-label">
    @isset($edit)
    Slaptažodis <i class="fa fa-lock"></i>
    @else
    *Slaptažodis <i class="fa fa-lock"></i>
    @endisset
  </label>
  <input
    id="password"
    name="password"
    type="password"
    class="form-control @error('password') is-invalid @enderror"
    @isset($edit)
    data-toggle="tooltip"
    data-placement="left"
    title="Įveskite, norint pakeisti"
    @else
    required
    @endisset
    minlength="8"
    maxlength="69"
    autocomplete="new-password">

  @error('password')
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
  @enderror
</div>


<div class="form-group row">
  <label for="password_confirmation" class="col-form-label" data-toggle="tooltip">
    @isset($edit)
    Pakartokite slaptažodį <i class="fa fa-lock"></i>
    @else
    *Pakartokite slaptažodį <i class="fa fa-lock"></i>
    @endisset
  </label>
  <input
    id="password_confirmation"
    name="password_confirmation"
    type="password"
    class="form-control"
    @isset($edit)
    data-toggle="tooltip"
    data-placement="left"
    title="Pakartokite, norint pakeisti"
    @else
    required
    @endisset
    minlength="8"
    maxlength="69"
    autocomplete="new-password">
</div>


<div class="form-group row">
  <label for="adresas" class="col-form-label">Adresas <i class="fa fa-map-marker"></i></label>
  <input
    id="adresas"
    name="adresas"
    type="text"
    class="form-control @error('adresas') is-invalid @enderror"
    value="{{ old('adresas') ?? $user->adresas ?? '' }}"
    minlength="3"
    maxlength="123"
    autocomplete="street-address">
</div>


<div class="form-group row">
  <label for="miestas" class="col-form-label">Miestas <i class="fa fa-building"></i></label>
  <input
    id="miestas"
    name="miestas"
    type="text"
    class="form-control @error('miestas') is-invalid @enderror"
    value="{{ old('miestas') ?? $user->miestas ?? '' }}"
    minlength="3"
    maxlength="69"
    autocomplete="address-level2">
</div>


<div class="form-group row">
  <label for="salis" class="col-form-label">Šalis <i class="fa fa-globe"></i></label>
  <input
    id="salis"
    name="salis"
    type="text"
    class="form-control @error('salis') is-invalid @enderror"
    value="{{ old('salis') ?? $user->salis ?? '' }}"
    minlength="3"
    maxlength="69"
    autocomplete="country-name">
</div>


<div class="form-group row">
  <label for="pasto_kodas" class="col-form-label">Pašto kodas <i class="fa fa-envelope"></i></label>
  <input
    id="pasto_kodas"
    name="pasto_kodas"
    type="text"
    class="form-control @error('pasto_kodas') is-invalid @enderror"
    value="{{ old('pasto_kodas') ?? $user->pasto_kodas ?? '' }}"
    pattern="[A-Za-z0-9]{2,3}[0-9]{0,2}[- ]?[0-9]{2,5}"
    autocomplete="postal-code">
</div>


<div class="form-group row">
  <button type="submit" class="btn btn-danger">
    @isset($edit)
      Išsaugoti
    @else
      Registruotis
    @endisset
  </button>
</div>
