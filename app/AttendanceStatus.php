<?php

declare(strict_types=1);

namespace App;

enum AttendanceStatus: string
{
    //
    case PRESENT = 'present';
    case ABSENT = 'absent';
    // case EXCUSED = 'excused';
    // case LATE = 'late';

    public function label(): string
    {
        return match ($this) {
            self::PRESENT => 'Attended',
            self::ABSENT => 'Absent',
            // self::EXCUSED => 'Premitted Absence',
            // self::LATE => 'Arrived Late',
        };
    }
}
