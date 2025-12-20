<!-- Settings Tab -->
@php 
    $user = Auth::user();
@endphp
<div class="tab-pane fade" id="parametre">
    <div class="section-header" data-aos="fade-up">
        <h2>Paramètre du compte</h2>
    </div>

    <div class="settings-content">
        <div class="settings-section" data-aos="fade-up">
            <h3> Information Personnelle</h3>
            <form class="php-email-form settings-form" action="{{ route('profile.edit') }}" method="post">
                @csrf
                @method('patch')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="prenom" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" value="{{ old('prenom',$user->prenom) }}" required="">
                    </div>
                    <div class="col-md-6">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom',$user->nom) }}" required="">
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email',$user->email) }}" required="">
                    </div>
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Téléphone</label>
                        <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone',$user->phone) }}">
                    </div>
                </div>

                <div class="form-buttons mb-2">
                    <button type="submit" class="btn-save bg-green-800">Enregistrer les changements</button>
                </div>

                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your changes have been saved successfully!</div>
            </form>
        </div>

        <!-- Email Preferences -->
        <div class="settings-section" data-aos="fade-up" data-aos-delay="100">
            <h3>Email Preferences</h3>
            <div class="preferences-list">
                <div class="preference-item">
                <div class="preference-info">
                    <h4>Order Updates</h4>
                    <p>Receive notifications about your order status</p>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="orderUpdates" checked="">
                </div>
                </div>

                <div class="preference-item">
                <div class="preference-info">
                    <h4>Promotions</h4>
                    <p>Receive emails about new promotions and deals</p>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="promotions">
                </div>
                </div>

                <div class="preference-item">
                <div class="preference-info">
                    <h4>Newsletter</h4>
                    <p>Subscribe to our weekly newsletter</p>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="newsletter" checked="">
                </div>
                </div>
            </div>
        </div>

        <!-- Securité du compte -->
        <div class="settings-section" data-aos="fade-up" data-aos-delay="200">
            <h3>Securité</h3>
            <form class="php-email-form settings-form" method="post" action="{{ route('account.password') }}">
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <div class="col-md-12">
                        <label for="currentPassword" class="form-label">Ancien Mot de Passe</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="currentPassword" required="">
                        @error('password')
                            <div class="error-message">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="newPassword" class="form-label">Nouveau Mot de Passe</label>
                        <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" id="newPassword" required="">
                        @error('new_password')
                            <div class="error-message">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="confirmPassword" class="form-label">Confirmer Mot de Passe</label>
                        <input type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror" name="new_password_confirmation" id="confirmPassword" required="">
                        @error('new_password_confirmation')
                            <div class="error-message">{{$message}}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-buttons mb-2">
                    <button type="submit" class="btn-save">Modifier Mot de Passe</button>
                </div>

                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Votre mot de passe a été mise à jour avec succès!</div>
            </form>
        </div>

        <!-- Supprimer le compte -->
        <div class="settings-section danger-zone" data-aos="fade-up" data-aos-delay="300">
            <h3>Supprimer le compte</h3>
            <div class="danger-zone-content">
                <p>Une fois que vous supprimez votre compte, il n'y a pas de retour en arrière. Veuillez être sûr...</p>
                <button type="button" class="btn-danger">Supprimer le compte</button>
            </div>
        </div>
    </div>
</div>