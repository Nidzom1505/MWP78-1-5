package com.example.pert7no1.DB

import android.util.Log
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.withContext
import java.sql.Connection
import java.sql.DriverManager
import java.sql.SQLException

object KoneksiDB {
    private const val URL = "jdbc:postgresql://10.0.2.2:5432/MWP"
    private const val USER = "postgres"
    private const val PASSWORD = "nidzom15"

    suspend fun getConnection(): Connection? {
        return withContext(Dispatchers.IO) { // Jalankan di thread background
            try {
                Class.forName("org.postgresql.Driver") // Load driver secara manual
                val conn = DriverManager.getConnection(URL, USER, PASSWORD)
                Log.d("DB_CONNECT", "Koneksi berhasil!")
                conn
            } catch (e: ClassNotFoundException) {
                Log.e("DB_ERROR", "Driver tidak ditemukan: ${e.message}")
                null
            } catch (e: SQLException) {
                Log.e("DB_ERROR", "Gagal koneksi: ${e.message}")
                null
            }
        }
    }
}
