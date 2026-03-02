<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content;

class AdminContentController extends Controller
{
    //
        public function index(Request $request)
        {
            $query =    Content::with(['app', 'author', 'approver'])->latest();

            if($request->status) {
                $query->where('status', $request->status);
            }

            if ($request->app_id) {
                $query->where('app_id', $request->app_id);
            }
            return response()->json([
                'data' => $query->paginate(10),
            ]);
        }

        public function approve(Request $request, $id)
        {
            $content = Content::findOrFail($id);

            $content->update([
                'status' => 'published',
                'published_at' => now(),
                'approved_by' => $request->user()->id,
                

            ]);

            return response()->json([
                'message' => 'Konten berhasil di approve dan dipublish',
                'data' => $content,
            ]);

        }

        public function reject(Request $request, $id)
        {
            $data = $request->validate([
                'note_project' => ['required', 'string'],

            ]);

            $content = Content::findOrFail($id);

            $content->update([
                'status' => 'rejected',
                'approved_by' => $request->user()->id,
                'note_project' => $data['note_project'],
                'published_at' => null,
            ]);

            return response()->json([
                'message' => 'konten berasil di tolak',
                'data' => $content,
            ]);
        }
        public function destroy($id)
        {
            try {
                $content = Content::find($id);

                if (!$content) {
                    return response()->json(['message' => 'Konten tidak ditemukan'], 404);
                }

                $content->delete();

                return response()->json(['message' => 'Konten berhasil dihapus']);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Gagal menghapus data', 'error' => $e->getMessage()], 500);
            }
        }
        public function update(Request $request, $id)
        {
            try {
                $content = Content::find($id);

                if (!$content) {
                    return response()->json(['message' => 'Konten tidak ditemukan'], 404);
                }

                // Validasi data yang masuk dari React
                $data = $request->validate([
                    'title'    => 'required|string|max:255',
                    'body'     => 'required|string', 
                    'category' => 'required|string',
                ]);

                $content->update($data);

                return response()->json([
                    'message' => 'Konten berhasil diperbarui',
                    'data'    => $content
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'Gagal memperbarui data',
                    'error'   => $e->getMessage()
                ], 500);
            }
        }
        public function show($id)
        {
            try {
                // Mengambil data beserta relasinya agar lengkap di halaman edit
                $content = Content::with(['app', 'author'])->find($id);

                if (!$content) {
                    return response()->json(['message' => 'Konten tidak ditemukan'], 404);
                }

                return response()->json($content);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Terjadi kesalahan server', 'error' => $e->getMessage()], 500);
            }
        }
}