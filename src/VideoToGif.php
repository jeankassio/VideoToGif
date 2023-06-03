<?php

namespace JeanKassio;

use FFMpeg\FFProbe;
use FFMpeg\FFMpeg;
use FFMpeg\Coordinate\TimeCode;
use FFMpeg\Coordinate\Dimension;

class VideoToGif{
	
    public function convert($videoBase64){
        // Decodificar o vídeo base64 e salvá-lo em um arquivo temporário
        $videoPath = tempnam(sys_get_temp_dir(), 'video').".mp4" ;
        file_put_contents($videoPath, base64_decode($videoBase64));

        // Obter informações do vídeo usando FFprobe
        $ffprobe = FFProbe::create();
        $videoInfo = $ffprobe->streams($videoPath)->videos()->first();

        // Extrair o FPS, largura e altura do vídeo
        $fps = $videoInfo->get('r_frame_rate');
        $width = $videoInfo->get('width');
        $height = $videoInfo->get('height');
        $duration = $videoInfo->get('duration');

        // Configurar o FFmpeg
        $ffmpeg = FFMpeg::create();

        // Converter para GIF
        $gifPath = tempnam(sys_get_temp_dir(), 'gif').".gif";
        $video = $ffmpeg->open($videoPath);
		
		$video->gif(TimeCode::fromSeconds(0), new Dimension($width, $height), 5)->save($gifPath);
		
        // Ler o arquivo GIF
        $gifData = file_get_contents($gifPath);

        // Codificar a saída em base64
        $gifBase64 = base64_encode($gifData);

        // Remover os arquivos temporários
        unlink($videoPath);
        unlink($gifPath);

        // Retornar o resultado em base64, juntamente com as informações do vídeo
        return [
            'gif' => $gifBase64,
            'fps' => $fps,
            'width' => $width,
            'height' => $height
        ];
    }
}
