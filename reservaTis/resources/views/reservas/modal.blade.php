<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-delete-{{$res->id_reserva}}">

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Eliminar Reserva</h4>
			</div>
			<div class="modal-body">
				<p>Confirme si desea Eliminar la reserva</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

				<a href="{{ route('reservas.destroy', $res->id_reserva) }}" onclick="return true" class="btn btn-danger">Eliminar</a>

				
			</div>
		</div>
	</div>
	{

</div>