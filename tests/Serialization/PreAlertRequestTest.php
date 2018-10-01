<?php
/**
 * This code is licensed under the MIT License.
 *
 * Copyright (c) 2018 Appwilio (http://appwilio.com), greabock (https://github.com/greabock), JhaoDa (https://github.com/jhaoda)
 * Copyright (c) 2018 Alexey Kopytko <alexey@kopytko.com> and contributors
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

declare(strict_types=1);

namespace Tests\CdekSDK\Serialization;

use CdekSDK\Common\Order;
use CdekSDK\Requests\PreAlertRequest;

/**
 * @covers \CdekSDK\Requests\PreAlertRequest
 */
class PreAlertRequestTest extends TestCase
{
    public function test_can_serialize()
    {
        $request = new PreAlertRequest([
            'PvzCode' => 'NSK333',
        ]);

        $request->date(new \DateTimeImmutable('2017-09-29'))->credentials('123', '456');

        $request = $request->addOrder(Order::create([
            'DispatchNumber' => 'bar',
        ]));
        $request = $request->addOrder(Order::create([
            'Number' => 'foo',
        ]));

        $this->assertSameAsXML('<?xml version="1.0" encoding="UTF-8"?>
<PreAlert OrderCount="2" Date="2017-09-29" Account="123" Secure="456" PvzCode="NSK333">
  <Order DispatchNumber="bar"/>
  <Order Number="foo"/>
</PreAlert>
', $request);
    }
}