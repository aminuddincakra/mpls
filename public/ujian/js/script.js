var qn = 0;
var no;
var myArray = []; 
var tipe = [];
function changesoal(no) {
    akhir = $('.soal').length;
    var t = $('.soal.active'),
        time = $('body').find('.waktu-mundur').text(),
        ujian = t.data('ujian'),
        link = $('body').data('waktu');

    $.ajax({
        type: "POST",
        data: {time: time, ujian: ujian},
        //dataType: 'json',
        url: link,
        success: function (data) {
            // signal 1     
        },
       	error: function (xhr, status, strErr) {
            alert("Terjadi error, silahkan refresh halaman dengan cara menekan F5");
        }
    });
    //console.log(no+" dan "+akhir);
    if (no === 0) {
        //
    } else if (no == akhir) {
        $('#nomor span').html(no);
        $('.no').removeClass('active');
        $('.no.no-' + no).addClass('active');
        $('#next-soal').hide();
        $('#last-soal').show();
    } else {
        $('#nomor span').html(no);
        $('.no').removeClass('active');
        $('.no.no-' + no).addClass('active');
        $('#next-soal').show();
        $('#last-soal').hide();
    }

    $('.ragu-check').removeClass('far fa-check-square');
    $('.ragu-check').removeClass('far fa-square');
    if ($('.no.active').hasClass('ragu-ragu')) {
        $('.ragu-check').addClass('far fa-check-square');
    } else {
        $('.ragu-check').addClass('far fa-square');
    }

}
 
function save_time() {

    var formData = {temp_time: TotalSeconds},
        waktu_mundur = $('.waktu-mundur'),
        url = waktu_mundur.data('link');
    $.ajax({
        type: "POST",
        data: formData,
        url: url,
        success: function (data) {
            console.log(data);
        },
        error: function (xhr, status, strErr) {
            console.log(status);
        }
    });
}

function jawab(){
     $('.option').click(function () {
        var t = $(this),
            klas_soal = t.closest('.soal'),
            soal_id = klas_soal.data('line'),
            kode = klas_soal.data('kode'),
            time = $('body').find('.waktu-mundur').text(),
            link = klas_soal.data('link'),
            ujian = klas_soal.data('ujian'),
            jwb = t.val(),
            abj = t.closest('.options').find('span').text();

        $(this).closest('.options-group').find('.option').each(function () {
            $(this).removeClass('checked');
            $(this).closest('.coolbox').find('span').attr('style','');
        }) 
        $(this).addClass('checked');
        $(this).closest('.options').find('span').css('color', 'red');
        nomor = $('.soal.active').find('.nomor').text();
        console.log('abjadnya adalah '+abj);
        $('.no.no-' + nomor + ' span').html(abj);
        $('.no.no-' + nomor).addClass('done');
        no = nomor - 1;
        nomor = $(this).closest('.active').attr('id');
        nomor = nomor.replace('nomor-asli-', '');
        ragu = $('.btn-warning.ragu span').hasClass('fa-check-square');
        if (ragu) {
            ragu = 'YA';
        } else {
            ragu = 'TIDAK';
        }

        var soal = $('input[name="question_type[]"]').map(function () {
            return this.value;
        }).get();
        var jawab = $('input[name="answer[' + no + '][]"]:checked').map(function () {
            return this.value;
        }).get();
       
        var qid = $('input[name="qid['+no+']"]').map(function(){
            return this.value;
        }).get();
        //data diganti MyArray untuk nyimpen satu-satu
        
        myArray[no] = jawab;
        tipe[no] = 1;
        //var rid = document.getElementById('rid').value;
        //var individual_time = document.getElementById('individual_time').value,
        //alert(opsi.attr('class'));
         
        $.ajax({
            type: "POST",
            data: {time: time, soal_id: soal_id, jawaban: t.val(), kode: kode, ragu: ragu, ujian: ujian},
            //dataType: 'json',
            url: link,
            success: function (data) {
                // signal 1
                $('#save_answer_signal2').css('backgroundColor', '#00ff00');
                setTimeout(function () {
                    $('#save_answer_signal2').css('backgroundColor', '#666666');
                }, 5000);
               myArray=[];
               tipe = [];     
            },
            error: function (xhr, status, strErr) {
                alert("Terjadi error, silahkan refresh halaman dengan cara menekan F5");

                // signal 1
                $('#save_answer_signal2').css('backgroundColor', '#ff0000');
                setTimeout(function () {
                    $('#save_answer_signal2').css('backgroundColor', '#666666');
                }, 5500);

            }
        });
    })
       
}

$(document).ready(function () {
    
    $(document).keydown(function(e){
        console.log(e.keyCode);
        if(e.keyCode == '65'){
            $('.soal.active').find('span').attr('style', '');
            $('.soal.active').find('input[type="radio"]').eq(0).click();
        }else if(e.keyCode == '66'){
            $('.soal.active').find('span').attr('style', '');
            $('.soal.active').find('input[type="radio"]').eq(1).click();
        }else if(e.keyCode == '67'){
            $('.soal.active').find('span').attr('style', '');
            $('.soal.active').find('input[type="radio"]').eq(2).click();
        }else if(e.keyCode == '68'){
            $('.soal.active').find('span').attr('style', '');
            $('.soal.active').find('input[type="radio"]').eq(3).click();
        }else if(e.keyCode == '69'){
            $('.soal.active').find('span').attr('style', '');
            $('.soal.active').find('input[type="radio"]').eq(4).click();
        }else if(e.keyCode == '32'){
            var current = $('.soal.active'),
                nomor = current.attr('id'),
                urut = nomor.replace("nomor-asli-", "");
            if(urut == $('.soal').length){
                $('#last-soal').click();
            }else{
                $('#next-soal').click();
            }
            console.log(urut)
        }
    });

   jawab();

    $('.ragu').click(function () {
        a = $(this).find('.ragu-check');
        if (a.hasClass('far fa-square')) {
            a.removeClass('far fa-square');
            a.addClass('far fa-check-square');
            nomor = $('.soal.active').find('.nomor').text();
            $('.no.no-' + nomor).addClass('ragu-ragu');
        } else {
            a.removeClass('far fa-check-square');
            a.addClass('far fa-square');
            nomor = $('.soal.active').find('.nomor').text();
            $('.no.no-' + nomor).removeClass('ragu-ragu');
        }
        $('.soal.active .option.checked').click();
        console.log('ok ini di klik');
    })

    $('.soal.active').each(function(){
        var t = $(this),
            nomor = t.data('nomor'),
            bodi = t.closest('#soal-body'),
            total = bodi.data('jumlah');

        if(nomor == total){
            $('#last-soal').show();
            $('#next-soal').hide();
        }else{
            $('#last-soal').hide();
            $('#next-soal').show();
        }        
    });

    $('.container-soal').each(function(){
        var t = $(this),
            id = t.data('id');

        setInterval(function(){ 
            $.ajax({
                type: "POST",
                data: {id: id},
                //dataType: 'json',
                url: '/siswa/cek-sesi',
                success: function (data) {
                    if(data == 0){
                        //satu window.location = $('body').data('expired');
                    }
                },
                error: function (xhr, status, strErr) {
                    alert("Terjadi error, silahkan refresh halaman dengan cara menekan F5");
                }
            });
        }, 30000);
    });

    $('.ragu').each(function(){
        var t = $(this),
            ragu = $('body').find('.soal.active'),
            nragu = ragu.data('ragu');
        
        if(nragu == 1){
            t.find('span').removeClass('fa-square');
            t.find('span').addClass('fa-check-square');
        }
    })

    $('.no').click(function () {
        nomor = $(this).find('p').html();
        $('.soal').removeClass('active');
        $('.soal.nomor-' + nomor).addClass('active');
        changesoal(nomor);
    })

    // $('#summary-button').click(function () {
    //     if ($(this).hasClass('show')) {
    //         $('#summary').hide();
    //         $(this).css('right', 0);
    //         $(this).find('button').html('<span class="fas fa-arrow-left" aria-hidden="true" style="position:relative; top:10px;"></span> Daftar <br/>Soal');
    //         $(this).removeClass('show');
    //     } else {
    //         $('#summary').show();
    //         $(this).css('right', 299);
    //         $(this).find('button').html('<span class="fas fa-arrow-right" aria-hidden="true"></span>');
    //         $(this).addClass('show');
    //     }
    // })

    $('#summary-button').click(function () {
        if ($(this).hasClass('show')) {
            $('#summary').hide();
            $(this).css('right', 0);
            $(this).find('button').html('<span class="fas fa-arrow-left" aria-hidden="true" style="position:relative; top:10px;"></span> Daftar <br/>Soal');
            $(this).removeClass('show');
        } else {
            $('#summary').show();
            $(this).css('right', 299);
            $(this).find('button').html('<span class="fas fa-arrow-right" aria-hidden="true"></span>');
            $(this).addClass('show');
        }
    })
    

    $('#next-soal').click(function () {
        $('.soal.active').next().addClass('active');
        $('.soal.active').eq(0).removeClass('active');
        nomor = $('.soal.active').find('.nomor').text();
        changesoal(nomor);
    })
    $('#prev-soal').click(function () {
        $('.soal.active').prev().addClass('active');
        $('.soal.active').eq(1).removeClass('active');
        nomor = $('.soal.active').find('.nomor').text();
        changesoal(nomor);
    })

    $('#summary-button').click();

})
// var base_url = "http://ujian.nguprek.com/";
var Timer;
var TotalSeconds;


function CreateTimer(TimerID, Time) {
    Timer = document.getElementById(TimerID);
    TotalSeconds = Time;

    UpdateTimer()
    window.setTimeout("Tick()", 1000);
}

function Tick() {
    if (TotalSeconds <= 0) {
        //alert("Time's up!");
        var id = $('body').data('ujian'),
          selesai = $('body').data('selesai');

        $.ajax({
            type: "POST",
            data: {ujian: id},
            //dataType: 'json',
            url: '/waktu-selesai',
            success: function (data) {
                $('#ragu-selesai').modal('show');
            },
            error: function (xhr, status, strErr) {
                alert("Terjadi error, silahkan refresh halaman dengan cara menekan F5");
            }
        });

    	//window.location = $('body').data('selesai')+'/'+id;
        return;
    }

    TotalSeconds -= 1;
    UpdateTimer()
    window.setTimeout("Tick()", 1000);
}

$(document).on('show.bs.modal', '#ragu-selesai', function () {
    var button = $(this).find('button');

    button.click(function(){        
        window.location = $('body').data('selesai')+'/'+$('body').data('ujian');
    });   
});

function UpdateTimer() {
    var Seconds = TotalSeconds;

    var Days = Math.floor(Seconds / 86400);
    Seconds -= Days * 86400;

    var Hours = Math.floor(Seconds / 3600);
    Seconds -= Hours * (3600);

    var Minutes = Math.floor(Seconds / 60);
    Seconds -= Minutes * (60);


    var TimeStr = ((Days > 0) ? Days + " days " : "") + LeadingZero(Hours) + ":" + LeadingZero(Minutes) + ":" + LeadingZero(Seconds)


    Timer.innerHTML = TimeStr;
}


function LeadingZero(Time) {

    return (Time < 10) ? "0" + Time : +Time;

}

//var myCountdown1 = new Countdown({time:1152, rangeHi:"hour", rangeLo:"second"});
setTimeout(submitform, '1152000');

function submitform() {
    //alert('Time Over');
    var id = $('body').data('ujian'),
        selesai = $('body').data('selesai');

    //tiga window.location = $('body').data('feed')+'/'+id;
    
    /*$.ajax({
        type: "POST",
        data: {id: id},
        //dataType: 'json',
        url: selesai,
        success: function (data) {
            window.location = $('body').data('feed')+'/'+id;
        },
        error: function (xhr, status, strErr) {
            alert("Terjadi error, silahkan refresh halaman dengan cara menekan F5");
        }
    });*/
    //window.location = $('body').data('link');
}

function tutup() {
    $('#yakin-modal').hide();
}

function tutupRagu(){
    $('#ragu-modal').hide();
}

//selesai dengan tombol selesai
function selesai() {
    var id = $('body').data('ujian'),
        selesai = $('body').data('selesai');
    
    if ($('#yakin').is(":checked")) {
    	window.location = $('body').data('selesai')+'/'+id;
    } else {
        alert('Silahkan Pilih Centang Terlebih Dahulu');
    }
}
var ctime = 0;
var ind_time = new Array();
    ind_time[0] =60;
        ind_time[1] =0;
        ind_time[2] =0;
        ind_time[3] =0;
        ind_time[4] =0;
        ind_time[5] =0;
        ind_time[6] =0;
        ind_time[7] =0;
        ind_time[8] =0;
        ind_time[9] =0;
    noq = "10";
//show_question('0');


function increasectime() {

    ctime += 1;

}
setInterval(increasectime, 1000);

$(document).ready(function () {
    $('#finish').text('11 January 2016 17:00:00');
    $('#last-soal').click(function () {
        if ($('.not-done').length > 0) {
            $('#ragu-modal').show();
        } else {
            if ($('.ragu-ragu').length > 0) {
                $('#ragu-modal').show();
            } else {
                $('#yakin-modal').show();
            }
        }
    })
});

var ctime = 0;
var ind_time = new Array();
    ind_time[0] =60;
        ind_time[1] =0;
        ind_time[2] =0;
        ind_time[3] =0;
        ind_time[4] =0;
        ind_time[5] =0;
        ind_time[6] =0;
        ind_time[7] =0;
        ind_time[8] =0;
        ind_time[9] =0;
    noq = "10";
//show_question('0');

function increasectime() {

    ctime += 1;

}
setInterval(increasectime, 1000);