<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    //
    public function update(Request $request, Approval $approval)
{
    $approval->update([
        'status' => $request->status,
    ]);

    $allApprovals = $approval->booking->approvals;
    if ($allApprovals->every(fn($a) => $a->status == 'approved')) {
        $approval->booking->update(['status' => 'approved']);
    } elseif ($allApprovals->contains(fn($a) => $a->status == 'rejected')) {
        $approval->booking->update(['status' => 'rejected']);
    }

    return redirect()->back()->with('success', 'Approval status updated.');
}

}
