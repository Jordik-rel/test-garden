<div class="section-header justify-between items-center" data-aos="fade-up">
    <h2>{{ $user->jardinier->profession }}</h2>
    <button class="btn-edit" type="button" aria-label="Modifier" data-bs-toggle="modal" data-bs-target="#modifierModal{{$user->jardinier->id}}">
        <i class="bi bi-pencil text-orange-500"></i>
    </button>
</div>

 <!-- Modale Bootstrap -->
<div class="modal fade" id="modifierModal{{ $user->jardinier->id }}" tabindex="-1" aria-labelledby="modifierModalLabel{{ $user->jardinier->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modifierModalLabel{{ $user->jardinier->id }}">Modifier Jardinier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <form id="modifierForm{{ $user->jardinier->id }}" action="{{ route('admin.jardinier.update',$user->jardinier)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="w-full flex flex-col mb-3">
                        <label for="profession" class="form-label">Profession</label>
                        <select name="profession" id="profession" class="form-control @error('profession') is-invalid @enderror">
                            <option value="jardinier"> Jardinier</option>
                            <option value="ovirus"> Ovirus</option>
                        </select>
                        @error("profession")
                            <div class="invalid-feedback">
                                    {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="w-full flex flex-col mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control">{{ $user->jardinier->description }}</textarea>
                        @error("description")
                            <div class="invalid-feedback">
                                    {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="flex justify-between items-center mb-2">
                        <div class="w-[50%] mr-2">
                            <label for="tarif_horaire" class="form-label">Tarif Horaire</label>
                            <input type="text" name="tarif_horaire" class="form-control @error('tarif_horaire') is-invalid @enderror" placeholder="{{old('tarif_horaire',$user->jardinier->tarif_horaire)}}" id="tarif_horaire" value="{{old('tarif_horaire',$user->jardinier->tarif_horaire)}}">
                            @error("tarif_horaire")
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="w-[50%] mr-2">
                            <label for="tarif_journalier" class="form-label">Tarif Journalière</label>
                            <input type="text" name="tarif_journalier" class="form-control @error('tarif_journalier') is-invalid @enderror" placeholder="{{old('tarif_journalier',$user->jardinier->tarif_journalier)}}" id="tarif_journalier" value="{{old('tarif_journalier',$user->jardinier->tarif_journalier)}}">
                            @error("tarif_journalier")
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="w-full flex flex-col mb-1">
                        <label for="site_web" class="text-black font-semibold px-1 mb-1">Site web</label>
                        <input type="text" value="" name="site_web" placeholder="www.majardinierie.com" class="form-control w-full border-[1px] @error('site_web') is-invalid @enderror focus:border-green-700 border-solid border-slate-400 focus:outline-0 focus:border-0 rounded-md" id="site_web" autocomplete="off">
                        <x-input-error :messages="$errors->get('site_web')" class="mt-2" />
                    </div>
                    <div class="block mb-2">
                        <label for="disponible" class="inline-flex items-center mb-1">
                            <input id="disponible" type="checkbox" value="1" {{ old('disponible', $user->jardinier->disponible ?? false) ? 'checked' : '' }} class="rounded dark:bg-gray-900 border-slate-500  @error('disponible') is-invalid @enderror dark:border-gray-700 text-green-600 shadow-sm focus:ring-green-500 dark:focus:ring-green-600 dark:focus:ring-offset-gray-800" name="disponible">
                            <span class="ms-2 text-md text-gray-600 dark:text-gray-400">{{ __('Disponible') }}</span>
                        </label>
                        @error("disponible")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" form="modifierForm{{ $user->jardinier->id }}" class="btn btn-warning">Mettre à jour</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>