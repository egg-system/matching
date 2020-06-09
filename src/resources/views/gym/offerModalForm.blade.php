<button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#offer-{{ $condition->id }}">
    オファーする
</button>
{{-- モーダル --}}
<form action="{{ route('offer.store', ['to' => $condition->user->login->id]) }}" method="post">
    @csrf
    <x-modal>
        <x-slot name="modal_id">
            offer-{{ $condition->id }}
        </x-slot>
        <x-slot name="modal_title">
            オファーの実行
        </x-slot>
        <x-slot name="modal_body">
            <textarea class="form-control form-control-sm" name="message" id="" cols="30" rows="10"></textarea>
        </x-slot>
        <x-slot name="modal_footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                キャンセル
            </button>
            <button type="submit" class="btn btn-success">
                送信
            </button>
        </x-slot>
    </x-modal>
</form>
