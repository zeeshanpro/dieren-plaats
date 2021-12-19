     // barColors    : {
     //            '0'      : 'rgba(4,  88, 214, .9)',
                // '.25'    : 'rgba(52,  152, 219, .9)',
                // '.50'    : 'rgba(241, 196, 15,  .9)',
                // '.75'    : 'rgba(230, 126, 34,  .9)',
                // '1.0'    : 'rgba(211, 84,  0,   .9)'
              // },

  function resetToDefaults() {
            topbar.config({
              autoRun      : true,
              barThickness : 5,
              barColors    : {
                '0'      : 'rgba(255,  255, 255, .9)',
            
              },
              shadowBlur   : 10,
              shadowColor  : 'rgba(0,   0,   0,   .6)',
              className    : 'topbar'
            })
          }

  function showLoader()
  {
     resetToDefaults()
      topbar.show();
  }

  function hideLoader()
  {
     topbar.hide();
  }
  resetToDefaults();