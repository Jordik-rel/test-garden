<!-- Mes Compétences -->
@if( $user->jardinier->competences->isEmpty())
    <div class="collapse tracking-info" id="competence1">
            <div class="order-footer">
                <button type="button" class="btn-track" data-bs-toggle="modal" data-bs-target="#addcompetence">Ajouter une Compétence</button>
            </div>
    </div>
@else

    @php
        $competences = $user->jardinier->competences;
    @endphp
    <div class="collapse tracking-info" id="competence1">
        <div class="tracking-timeline">
            @foreach($competences as $competence)
                <div class="timeline-item completed">
                    <div class="timeline-icon">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <div class="timeline-content">
                        <h5>{{ $competence->nom }}</h5>
                        <span class="timeline-date">Acquis le {{ $competence->created_at?->format('d M, Y') }}</span>
                    </div>
                </div>
            @endforeach
            <div class="timeline-item completed">
                <div class="timeline-icon">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <div class="timeline-content">
                    <h5>Maitrise de la tonte</h5>
                    <span class="timeline-date">Feb 20, 2025 - 10:30 AM</span>
                </div>
            </div>
        </div>
    </div>
@endif


<!-- Ajouter une(des) Competence(e) -->
<div class="modal fade" id="addcompetence" tabindex="-1" aria-labelledby="addcompetence" aria-hidden="false">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addcompetence">Ajouter Compétence</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
        </div>
        <div class="modal-body">
            <form id="addcompetence" action="{{ route('jardinier.competence.store')}}" method="POST">
                @csrf
                <label for="site_web" class="text-black font-semibold px-1 mb-1">Les compétences</label>
                <select name="competences[]" id="competences" multiple class="form-select">
                    @foreach($competences as $competence)
                        <option value="{{$competence->id}}">{{$competence->nom}}</option>
                    @endforeach
                </select>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-warning">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>