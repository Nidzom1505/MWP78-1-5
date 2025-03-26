package com.example.pert7no1

import android.os.Bundle
import android.util.Log
import androidx.activity.enableEdgeToEdge
import androidx.appcompat.app.AppCompatActivity
import androidx.core.view.ViewCompat
import androidx.core.view.WindowInsetsCompat
import com.example.pert7no1.DB.KoneksiDB
import kotlinx.coroutines.*

class PertamaActivity : AppCompatActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        enableEdgeToEdge()
        setContentView(R.layout.activity_pertama)
        ViewCompat.setOnApplyWindowInsetsListener(findViewById(R.id.main)) { v, insets ->
            val systemBars = insets.getInsets(WindowInsetsCompat.Type.systemBars())
            v.setPadding(systemBars.left, systemBars.top, systemBars.right, systemBars.bottom)
            insets
        }
//        CoroutineScope(Dispatchers.Main).launch {
//            val connection = withContext(Dispatchers.IO) { KoneksiDB.getConnection() }
//            if (connection != null) {
//                Log.d("DB", "Koneksi ke database berhasil!")
//            } else {
//                Log.e("DB", "Koneksi ke database gagal!")
//            }
//        }
    }
}