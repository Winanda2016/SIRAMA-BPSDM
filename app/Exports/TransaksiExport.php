namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class TransaksiExport implements FromCollection, WithHeadings
{
    protected $transaksi;

    public function __construct(Collection $transaksi)
    {
        $this->transaksi = $transaksi;
    }

    public function collection()
    {
        return $this->transaksi;
    }

    public function headings(): array
    {
        return [
            'ID Transaksi',
            'Nama Ruangan',
            'Status Transaksi',
            'Tanggal Check In',
            'Tanggal Check Out',
            'Total Harga',
            // Tambahkan header lain yang diperlukan
        ];
    }
}
